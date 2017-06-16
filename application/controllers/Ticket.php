<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if($this->session->userdata("user")["user_type"] != "OPERATOR") {
			redirect("dashboard");
		}
		$this->template_data["session_user"] = $this->session->userdata("user");

		$this->data = array();
		if($this->session->flashdata("info")) {
			$this->data["info"] = $this->session->flashdata("info");
		}
	}

	public function index() {
			$this->load->model("ticket_model");
			$this->data["ticket"] = $this->ticket_model->select_all();
			$this->template_data["content"] = $this->load->view("ticket_list", $this->data, TRUE);
			$this->load->view("template", $this->template_data);
	}

	public function add(){
		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$event_date = $this->input->post("event_date");
			$description = $this->input->post("description");
			$solved_date = $this->input->post("solved_date");
			$troubleshoot = $this->input->post("troubleshoot");
			$solved = $solved_date != null ? "Y": "N";
			$user_id = $this->session->userdata("user")["id"];
			$user_id_solved = $this->input->post("user_id_solved");
			$document_path = "";

			//configuration upload
			$config["upload_path"] = "uploads/troubleshoot/";
			$config["allowed_types"] ="doc|docx|pdf|xls|xlsx|ppt|pptx|pages|numbers|key";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);

			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
      		$file = $this->upload->data();
      		$document_path = $config['upload_path'].$file["file_name"];
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(),
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("troubleshoot/add");
      	}
			}

			//	insert to asset troubleshoot table
			$this->load->model("troubleshoot_model");
			$this->troubleshoot_model->insert(
				$asset_id, $event_date, $description, $solved_date, $troubleshoot, $solved,
				$user_id, $user_id_solved, $document_path);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem",
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}
		if($param != 0) {
			$this->data["asset_id"] = $param;
		}

		$this->load->model("asset_model");
		$this->load->model("user_model");
		$this->data["asset"] = $this->asset_model->select_all();
		$this->data["user"] = $this->user_model->select_all();
		$this->template_data["content"] = $this->load->view("troubleshoot_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id){
		$this->load->model("asset_model");
		$this->load->model("user_model");
		$this->load->model("troubleshoot_model");

		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$event_date = $this->input->post("event_date");
			$description = $this->input->post("description");
			$solved_date = $this->input->post("solved_date");
			$troubleshoot = $this->input->post("troubleshoot");
			$solved = $solved_date != "" ? "Y": "N";
			$user_id_solved = $this->input->post("user_id_solved");
			$document_path = $this->input->post("document_path_old");

			//configuration upload
			$config["upload_path"] = "uploads/troubleshoot/";
			$config["allowed_types"] ="doc|docx|pdf|xls|xlsx|ppt|pptx|pages|numbers|key";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);

			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
					// delete old document
					if($document_path != ""){
						unlink("./".$document_path);
					}

					// upload new document
      		$file = $this->upload->data();
      		$document_path = $config['upload_path'].$file["file_name"];
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(),
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("troubleshoot/modify/".$id);
      	}
			}

			//	insert to asset troubleshoot table
			$this->troubleshoot_model->update(
				$asset_id, $event_date, $description, $solved_date, $troubleshoot, $solved,
				$user_id_solved, $document_path, $id);

			$info = array(
				"text" => "data berhasil diupdate ke sistem",
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}

		$this->data["asset"] = $this->asset_model->select_all();
		$this->data["troubleshoot"] = $this->troubleshoot_model->select_by_id($id);
		$this->data["user"] = $this->user_model->select_all();
		$this->template_data["content"] = $this->load->view("troubleshoot_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function drop($id){
		$this->load->model("troubleshoot_model");
		$this->troubleshoot_model->delete($id);
		$info = array(
			"text" => "data berhasil dihapus dari sistem",
			"class" => "alert-danger");
		$this->session->set_userdata("info", $info);
		redirect("troubleshoot");
	}
}
