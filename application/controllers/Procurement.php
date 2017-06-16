<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement extends CI_Controller {

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
			$this->load->model("procurement_model");
			$this->data["procurement"] = $this->procurement_model->select_all();
			$this->template_data["content"] = $this->load->view("procurement_list", $this->data, TRUE);
			$this->load->view("template", $this->template_data); 
	}

	public function add(){
		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$filling_date = date("Y-m-d");
			$description = $this->input->post("description");
			$done_date = $this->input->post("done_date");
			$status = $this->input->post("status");
			$user_id = $this->session->userdata("user")["id"];
			$document_path = "";
			
			//configuration upload
			$config["upload_path"] = "uploads/procurement/";
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
      		redirect("procurement/add");
      	}
			}

			//	insert to asset procurement table
			$this->load->model("procurement_model");
			$this->procurement_model->insert($asset_id, $filling_date, $description, $done_date, $status, $document_path, $user_id);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}
		$this->load->model("asset_model");
		$this->data["asset"] = $this->asset_model->select_all();
		$this->template_data["content"] = $this->load->view("procurement_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id) {
		$this->load->model("procurement_model");
		$this->load->model("asset_model");
		if($this->input->post()){
			$asset_id = $this->input->post("asset_id");
			$description = $this->input->post("description");
			$done_date = $this->input->post("done_date");
			$status = $this->input->post("status");
			$document_path = $this->input->post("document_path_old");
			
			//configuration upload
			$config["upload_path"] = "uploads/procurement/";
			$config["allowed_types"] ="doc|docx|pdf|xls|xlsx|ppt|pptx|pages|numbers|key";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
					//	remove old document
					if($document_path != ""){
						unlink("./".$document_path);
					}

					//upload new document
      		$file = $this->upload->data();
      		$document_path = $config['upload_path'].$file["file_name"];	
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(), 
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("procurement/add");
      	}
			}

			//	insert to asset procurement table
			
			$this->procurement_model->update($asset_id, $description, $done_date, $status, $document_path, $id);

			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}
		
		$this->data["procurement"] = $this->procurement_model->select_by_id($id);
		$this->data["asset"] = $this->asset_model->select_all();
		$this->template_data["content"] = $this->load->view("procurement_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function drop($id){
		$this->load->model("procurement_model");
		$this->procurement_model->delete($id);
		$info = array(
			"text" => "data berhasil dihapus dari sistem", 
			"class" => "alert-danger");
		$this->session->set_userdata("info", $info);
		redirect("procurement");	
	}
}



