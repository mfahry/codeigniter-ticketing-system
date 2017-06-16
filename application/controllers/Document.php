<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

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
			$this->load->model("document_model");
			$this->data["document"] = $this->document_model->select_all();
			$this->template_data["content"] = $this->load->view("document_list", $this->data, TRUE);
			$this->load->view("template", $this->template_data); 
	}

	public function add(){
		if($this->input->post()){
			$name = $this->input->post("name");
			$description = $this->input->post("description");
			$path = "";
			
			//configuration upload
			$config["upload_path"] = "uploads/document/";
			$config["allowed_types"] ="*";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
      		$file = $this->upload->data();
      		$path = $config['upload_path'].$file["file_name"];	
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(), 
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("document/add");
      	}
			}

			//	insert to asset document table
			$this->load->model("document_model");
			$this->document_model->insert($name, $description, $path);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}
		$this->template_data["content"] = $this->load->view("document_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id){
		$this->load->model("document_model");
		if($this->input->post()){
			$name = $this->input->post("name");
			$description = $this->input->post("description");
			$path = $this->input->post("path_old");
			
			//configuration upload
			$config["upload_path"] = "uploads/document/";
			$config["allowed_types"] ="*";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			// upload document if exist
			if($_FILES["document"]["name"] != ""){
				if($this->upload->do_upload("document")){
					//	remove old document
					if($path != ""){
						unlink("./".$path);
					}

					// upload new document
      		$file = $this->upload->data();
      		$path = $config['upload_path'].$file["file_name"];	
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(), 
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("document/modify/".$id);
      	}
			}

			//	insert to asset document table
			$this->document_model->update($name, $description, $path, $id);

			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;

		}
		$this->data["document"] = $this->document_model->select_by_id($id);
		$this->template_data["content"] = $this->load->view("document_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function drop($id){
		$this->load->model("document_model");
		$this->document_model->delete($id);
		$info = array(
			"text" => "data berhasil dihapus dari sistem", 
			"class" => "alert-danger");
		$this->session->set_userdata("info", $info);
		redirect("document");
	}
}



