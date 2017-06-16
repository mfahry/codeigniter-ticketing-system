<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		$this->template_data["session_user"] = $this->session->userdata("user");

		$this->data = array();
		if($this->session->userdata("info") != "") {
			$this->data["info"] = $this->session->userdata("info");
			$this->session->set_userdata("info","");
		}
		
	}

	public function index() {
			$this->load->model("maintenance_model");
			$this->data["maintenance"] = $this->maintenance_model->select_all();

			$this->template_data["content"] = $this->load->view("maintenance_list", $this->data, TRUE);
			$this->load->view("template", $this->template_data); 
	}

	public function add($param = 0){
		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$event_date = $this->input->post("event_date");
			$description = $this->input->post("description");
			$document_path = "";
			$user_id = $this->session->userdata("user")["id"];
			
			//configuration upload
			$config["upload_path"] = "uploads/maintenance/";
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
      		redirect("maintenance/add");
      	}
			}

			//	insert to asset maintenance table
			$this->load->model("maintenance_model");
			$this->maintenance_model->insert($asset_id, $event_date, $description, $document_path, $user_id);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}

		if($param != 0) {
			$this->data["asset_id"] = $param;
		}
		$this->load->model("asset_model");
		$this->data["asset"] = $this->asset_model->select_all();
		$this->template_data["content"] = $this->load->view("maintenance_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id){
		$this->load->model("maintenance_model");
		$this->load->model("asset_model");

		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$event_date = $this->input->post("event_date");
			$description = $this->input->post("description");
			$document_path = $this->input->post("document_path_old");
			
			//configuration upload
			$config["upload_path"] = "uploads/maintenance/";
			$config["allowed_types"] ="doc|docx|pdf|xls|xlsx|ppt|pptx|pages|numbers|key";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
					//	delete old document
					if($document_path != ""){
						unlink("./".$document_path);
					}

					//	upload new document
      		$file = $this->upload->data();
      		$document_path = $config['upload_path'].$file["file_name"];	
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(), 
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("maintenance/modify/".$id);
      	}
			}

			//	insert to asset maintenance table
			$this->maintenance_model->update($asset_id, $event_date, $description, $document_path, $id);
			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}
		$this->data["maintenance"] = $this->maintenance_model->select_by_id($id);
		$this->data["asset"] = $this->asset_model->select_all();
		$this->template_data["content"] = $this->load->view("maintenance_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function drop($id){
		$this->load->model("maintenance_model");
		$this->maintenance_model->delete($id);
		$info = array(
			"text" => "data berhasil dihapus dari sistem", 
			"class" => "alert-danger");
		$this->session->set_userdata("info", $info);
		redirect("maintenance");	
	}
}



