<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if(
			$this->session->userdata("user")["user_type"] != "SYS" &&
			$this->session->userdata("user")["user_type"] != "OPERATOR") {
			redirect("maintenance");
		}
		$this->template_data["session_user"] = $this->session->userdata("user");

		$this->data = array();
		if($this->session->userdata("info") != "") {
			$this->data["info"] = $this->session->userdata("info");
			$this->session->set_userdata("info","");
		}
	}

	public function index()
	{
		$this->load->model("dashboard_model");

		$period = date("Y-m");
		$this->data["maintenance"] = $this->dashboard_model->maintenance_total_per_month($period);
		$troubleshoot= $this->dashboard_model->troubleshoot_total_per_month($period);
		$this->data["troubleshoot_on"] = 0;
		$this->data["troubleshoot_off"] = 0;
		foreach($troubleshoot as $row){
			if($row["STATUS"] == "Y") {
				$this->data["troubleshoot_on"] = $row["TOTAL"];
			}
			else {
				$this->data["troubleshoot_off"] = $row["TOTAL"];
			}
		}

		$procurement = $this->dashboard_model->procurement_total_per_month($period);
		$this->data["procurement_pending"] = 0;
		$this->data["procurement_done"] = 0;
		foreach($procurement as $row){
			if($row["STATUS"] == "PENDING") {
				$this->data["procurement_pending"] = $row["TOTAL"];
			}
			else {
				$this->data["procurement_done"] = $row["TOTAL"];
			}
		}

		$this->data["user"] = $this->dashboard_model->latest_five_login();
		$this->template_data["content"] = $this->load->view("dashboard", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function generate_calendar_event(){
		$this->load->model("dashboard_model");
		$period = date("Y-m");
		$reminder_asset = $this->dashboard_model->reminder_asset_critical_date($period);
		$reminder_upcoming = $this->dashboard_model->reminder_upcoming_event($period);
		$event = array();
		foreach($reminder_asset as $row){
			$data = array();
			if(date("Y-m", strtotime($row["EXPIRED_MAINTENANCE_DATE"])) == $period) {
				$info = "Maintenance Habis";
				$data["start"] = $row["EXPIRED_MAINTENANCE_DATE"];
			}
			else if(date("Y-m", strtotime($row["END_OF_SALE_DATE"])) == $period) {
				$info = "End of Sale";
				$data["start"] = $row["END_OF_SALE_DATE"];
			}
			else if(date("Y-m", strtotime($row["END_OF_LIFE_DATE"])) == $period) {
				$info = "End of Life";
				$data["start"] = $row["END_OF_LIFE_DATE"];
			}
			else if(date("Y-m", strtotime($row["END_OF_SUPPORT_DATE"])) == $period) {
				$info = "End of Support";
				$data["start"] = $row["END_OF_SUPPORT_DATE"];
			}
			$data["title"] = $info." - ".$row["BRAND"]." / ".$row["TYPE"]." / ".$row["HOSTNAME"]." (".$row["IP_ADDRESS"].")";
			$data["extra"] = $row;
			$data["info"] = $info;
			array_push($event, $data);
		}

		foreach($reminder_upcoming as $row){
			$data = array();
			$data["title"] = "Schedule Terjadwal - ".$row["USERNAME"];
			$data["start"] = $row["REMINDER_DATE"];
			$data["extra"] = $row;
			array_push($event, $data);
		}

		echo json_encode($event);
	}

	public function generate_bar_chart(){
		$this->load->model("dashboard_model");
		$availability_asset = $this->dashboard_model->asset_availability_per_group();

		$data = array();
		$labels = array();
		$data_active = array();
		$data_non_active = array();
		foreach($availability_asset as $row){
			array_push($labels, $row["GROUP_NAME"]);
			array_push($data_active, $row["ACTIVE"]);
			array_push($data_non_active, $row["NON_ACTIVE"]);
		}
		$data["labels"] = $labels;

		$datasets = array();
		//	per dataset
		$dataset["label"] = "# of Available";
		$dataset["backgroundColor"] = "#26B99A";
		$dataset["data"] = $data_active;
		array_push($datasets, $dataset);

		$dataset["label"] = "# of Not Available";
		$dataset["backgroundColor"] = "#aeaeae";
		$dataset["data"] = $data_non_active;
		array_push($datasets, $dataset);

		$data["datasets"] = $datasets;
		echo json_encode($data);
	}
}
