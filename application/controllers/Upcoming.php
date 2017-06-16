<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upcoming extends CI_Controller {

	public function __construct() {
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

	public function index() {
			$this->load->model("upcoming_model");
			$this->data["upcoming"] = $this->upcoming_model->select_all();
			$this->template_data["content"] = $this->load->view("upcoming_list", $this->data, TRUE);
			$this->load->view("template", $this->template_data); 
	}

	public function add(){
		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$reminder_date = $this->input->post("reminder_date");
			$description = $this->input->post("description");
			$status = $this->input->post("status");
			$user_id = $this->session->userdata("user")["id"];

			//	insert to asset upcoming table
			$this->load->model("upcoming_model");
			$this->upcoming_model->insert($asset_id, $reminder_date, $description, $status, $user_id);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

  		if($this->input->post("activity") == "MAINTENANCE") {
  			$info["text"] .= ". Silahkan Masukkan Data Maintenance sesuai yang dilakukan";
  			$this->session->set_userdata("info",$info);
  			redirect("maintenance/add/".$asset_id);
  		}
  		else if($this->input->post("activity") == "TROUBLESHOOT"){
  			$info["text"] .= ". Silahkan Masukkan Data Troubleshoot sesuai yang dilakukan";
  			$this->session->set_userdata("info",$info);
  			redirect("troubleshoot/add/".$asset_id);	
  		}
		}
		$this->load->model("asset_model");
		$this->data["asset"] = $this->asset_model->select_all();
		$this->template_data["content"] = $this->load->view("upcoming_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id){
		$this->load->model("upcoming_model");
		$this->load->model("asset_model");

		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$reminder_date = $this->input->post("reminder_date");
			$description = $this->input->post("description");
			$status = $this->input->post("status");
			
			//	insert to asset upcoming table
			
			$this->upcoming_model->update($asset_id, $reminder_date, $description, $status, $id);

			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

  		if($this->input->post("activity") == "MAINTENANCE") {
  			$info["text"] .= ". Silahkan Masukkan Data Maintenance sesuai yang dilakukan";
  			$this->session->set_userdata("info",$info);
  			redirect("maintenance/add/".$asset_id);
  		}
  		else if($this->input->post("activity") == "TROUBLESHOOT"){
  			$info["text"] .= ". Silahkan Masukkan Data Troubleshoot sesuai yang dilakukan";
  			$this->session->set_userdata("info",$info);
  			redirect("troubleshoot/add/".$asset_id);	
  		}

		}
		$this->data["upcoming"] = $this->upcoming_model->select_by_id($id);
		$this->data["asset"] = $this->asset_model->select_all();
		$this->template_data["content"] = $this->load->view("upcoming_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function drop($id){
		$this->load->model("upcoming_model");
		$this->upcoming_model->delete($id);
		$info = array(
			"text" => "data berhasil dihapus dari sistem", 
			"class" => "alert-danger");
		$this->session->set_userdata("info", $info);
		redirect("upcoming");	
	}
}



