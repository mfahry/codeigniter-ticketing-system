<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();	
		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if(
			$this->session->userdata("user")["user_type"] != "SYS") {
			redirect("dashboard");
		}
		$this->template_data["session_user"] = $this->session->userdata("user");

		$this->data = array();
		if($this->session->userdata("info") != "") {
			$this->data["info"] = $this->session->userdata("info");
			$this->session->set_userdata("info","");
		}
	}

	public function index() {	
		$this->load->model("parameter_model");
		
		$this->data["parameter"] = $this->parameter_model->select_all();
		$this->template_data["content"] = $this->load->view("parameter_list", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function add(){
		if($this->input->post()){
			$name = $this->input->post("name");
			$value = $this->input->post("value");
			$description = $this->input->post("description");

			$this->load->model("parameter_model");
			$this->parameter_model->insert($name, $value, $description);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;
		}
		$this->template_data["content"] = $this->load->view("parameter_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id){
		$this->load->model("parameter_model");
		if($this->input->post()){
			$name = $this->input->post("name");
			$value = $this->input->post("value");
			$description = $this->input->post("description");
			
			$this->parameter_model->update($name, $value, $description, $id);

			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;
		}
		$this->data["parameter"] = $this->parameter_model->select_by_id($id);
		$this->template_data["content"] = $this->load->view("parameter_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}	
}
