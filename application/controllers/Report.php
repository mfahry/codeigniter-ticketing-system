<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if(
			$this->session->userdata("user")["user_type"] != "SYS" && 
			$this->session->userdata("user")["user_type"] != "ORGANIC") {
			redirect("maintenance");
		}
		$this->template_data["session_user"] = $this->session->userdata("user");

		$this->data = array();
		if($this->session->userdata("info") != "") {
			$this->data["info"] = $this->session->userdata("info");
			$this->session->set_userdata("info","");
		}
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function troubleshoot_per_day(){
		$this->template_data["content"] = $this->load->view("report_troubleshoot_per_day", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function troubleshoot_per_day_json($start_date = "", $end_date = "") {
		$start_date = $start_date == "" ? date("Y-m")."-01" : $start_date;
		$end_date = $end_date == "" ? date("Y-m-t") : $end_date;

		$this->load->model("report_model");		
		$result = $this->report_model->select_troubleshoot_per_day($start_date, $end_date);
		$data["labels"] = array();
		$data["datasets"] = array();
		$event_data = array();
		$solved_data = array();

		foreach($result as $row) {
			array_push($data["labels"], intval($row["DAY"]));
			array_push($event_data, $row["EVENT_TOTAL"]);
			array_push($solved_data, $row["SOLVED_TOTAL"]);
		}

		$dataset["label"] = "Jumlah Kejadian";
		//$dataset["fill"] = FALSE;
		//$dataset["lineTension"] = 0;
		$dataset["backgroundColor"] = "rgba(38, 185, 154, 0.31)";
		$dataset["borderColor"] = "rgba(38, 185, 154, 0.7)";
		$dataset["pointBorderColor"] = "rgba(38, 185, 154, 0.7)";
		$dataset["pointBackgroundColor"] = "rgba(38, 185, 154, 0.7)";
		$dataset["pointHoverBackgroundColor"] = "#fff";
		$dataset["pointHoverBorderColor"] = "rgba(220,220,220,1)";
		$dataset["pointBorderWidth"] = 1;
		$dataset["data"] = $event_data;

		array_push($data["datasets"], $dataset);

		$dataset["label"] = "Jumlah Troubleshoot Diselesaikan";
		//$dataset["fill"] = FALSE;
		//$dataset["lineTension"] = 0;
		$dataset["backgroundColor"] = "rgba(3, 88, 106, 0.3)";
		$dataset["borderColor"] = "rgba(3, 88, 106, 0.70)";
		$dataset["pointBorderColor"] = "rgba(3, 88, 106, 0.70)";
		$dataset["pointBackgroundColor"] = "rgba(3, 88, 106, 0.70)";
		$dataset["pointHoverBackgroundColor"] = "#fff";
		$dataset["pointHoverBorderColor"] = "rgba(151,187,205,1)";
		$dataset["pointBorderWidth"] = 1;
		$dataset["data"] = $solved_data;

		array_push($data["datasets"], $dataset);

		echo json_encode($data);
	}

	public function maintenance_per_day(){
		$this->template_data["content"] = $this->load->view("report_maintenance_per_day", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function maintenance_per_day_json($start_date = "", $end_date = "") {
		$start_date = $start_date == "" ? date("Y-m")."-01" : $start_date;
		$end_date = $end_date == "" ? date("Y-m-t") : $end_date;

		$this->load->model("report_model");		
		$result = $this->report_model->select_maintenance_per_day($start_date, $end_date);
		$data["labels"] = array();
		$data["datasets"] = array();
		$total = array();
		
		foreach($result as $row) {
			array_push($data["labels"], intval($row["DAY"]));
			array_push($total, $row["TOTAL"]);
		}

		$dataset["label"] = "Jumlah Maintenance";
		$dataset["backgroundColor"] = "rgba(38, 185, 154, 0.31)";
		$dataset["borderColor"] = "rgba(38, 185, 154, 0.7)";
		$dataset["pointBorderColor"] = "rgba(38, 185, 154, 0.7)";
		$dataset["pointBackgroundColor"] = "rgba(38, 185, 154, 0.7)";
		$dataset["pointHoverBackgroundColor"] = "#fff";
		$dataset["pointHoverBorderColor"] = "rgba(220,220,220,1)";
		$dataset["pointBorderWidth"] = 1;
		$dataset["data"] = $total;

		array_push($data["datasets"], $dataset);

		echo json_encode($data);
	}

	public function activity_per_organic(){
		$this->load->model("user_model");
		$this->data["user"] = $this->user_model->select_by_user_type("ORGANIC"); 
		$this->template_data["content"] = $this->load->view("report_activity_per_organic", $this->data, TRUE);
		$this->load->view("template", $this->template_data);	
	}

	public function activity_per_organic_json() {
		$period = $this->input->post("period") != "" ? $this->input->post("period") : date("Y-m");

		$this->load->model("report_model");		
		$result = $this->report_model->select_activity_per_organic($period);
		$user_data = array();
		
		foreach($result as $row) {
			$data["labels"] = array("Input Trouble", "Solved Trouble", "Maintenance", "Upcoming");
			$dataset = array();
			$dataset["data"] = array(
				$row["TROUBLESHOOT_TOTAL"], $row["TROUBLESHOOT_SOLVED_TOTAL"],
				$row["MAINTENANCE_TOTAL"], $row["UPCOMING_TOTAL"]);
			
			$dataset["backgroundColor"] = array ("#455C73", "#9B59B6", "#BDC3C7", "#26B99A");
			$dataset["hoverBackgroundColor"] = array ("#34495E", "#B370CF", "#CFD4D8", "#36CAAB");
			$data["datasets"] = array($dataset);
			$user_data["#activity-".$row["USER_ID"]] = $data;
		}

		echo json_encode($user_data);	
	}

	public function upcoming_per_organic(){
		$this->load->model("user_model");
		$this->data["user"] = $this->user_model->select_by_user_type("ORGANIC"); 
		$this->template_data["content"] = $this->load->view("report_upcoming_per_organic", $this->data, TRUE);
		$this->load->view("template", $this->template_data);	
	}

	public function upcoming_per_organic_json() {
		$period = $this->input->post("period") != "" ? $this->input->post("period") : date("Y-m");

		$this->load->model("report_model");		
		$result = $this->report_model->select_upcoming_per_organic($period);
		$user_data = array();
		
		foreach($result as $row) {
			$data["labels"] = array("Selesai", "Pending", "Menunggu Pengingat");
			$dataset = array();
			$dataset["data"] = array($row["DONE_TOTAL"], $row["PENDING_TOTAL"], $row["WAITING_REMINDER_TOTAL"]);
			
			$dataset["backgroundColor"] = array ("#455C73", "#9B59B6", "#BDC3C7");
			$dataset["hoverBackgroundColor"] = array ("#34495E", "#B370CF", "#CFD4D8");
			$data["datasets"] = array($dataset);
			$user_data["#upcoming-".$row["USER_ID"]] = $data;
		}

		echo json_encode($user_data);	
	} 	

}
