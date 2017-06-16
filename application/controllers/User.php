<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		$this->data = array();
		if($this->session->userdata("info") != "") {
			$this->data["info"] = $this->session->userdata("info");
			$this->session->set_userdata("info","");
		}
	}
	
	public function login() {
		
		//	check session 
		if(! is_null($this->session->userdata("user"))) {
			redirect("dashboard/");
		}
		else {
			if($this->input->post("signin") != null) {
				
				//	get POST param
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				
				//	load model
				$this->load->model("user_model");

				//	verify username and password
				$user = $this->user_model->select_by_username_password($username, $password);
				if($user != null) {
					$this->session->set_userdata("user", array(
						"id" => $user["ID"],
						"username" => $user["USERNAME"],
						"user_type" => $user["USER_TYPE"])
					);
					$this->session->set_userdata("info", "");
					
					redirect("dashboard/");
				}
				else {
					$this->session->set_userdata("info", "Username atau password salah. Silahkan periksa kembali");
					redirect("user/login");
				}
			}

			$this->load->view("login", $this->data);
		}	
	}

	public function index(){
		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if($this->session->userdata("user")["user_type"] != "SYS") {
			redirect("dashboard");
		}
		
		$this->template_data["session_user"] = $this->session->userdata("user");
		
		$this->load->model("user_model");
		$this->data["user"] = $this->user_model->select_all(TRUE);
		$this->template_data["content"] = $this->load->view("user_list", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function add(){
		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if($this->session->userdata("user")["user_type"] != "SYS") {
			redirect("dashboard");
		}
		
		$this->template_data["session_user"] = $this->session->userdata("user");

		if($this->input->post()){
			$username = $this->input->post("username");
			$user_type = $this->input->post("user_type");
			$password = md5($this->input->post("password"));
			$active = $this->input->post("active");

			$this->load->model("user_model");
			$this->user_model->insert($username, $user_type, $active, $password);

			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;
		}
		$this->template_data["content"] = $this->load->view("user_form", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function modify($id){
		//	check session user
		if(! $this->session->has_userdata("user")){
			redirect("user/login");
		}
		if($this->session->userdata("user")["user_type"] != "SYS") {
			redirect("dashboard");
		}
		
		$this->template_data["session_user"] = $this->session->userdata("user");

		$this->load->model("user_model");
		if($this->input->post()){
			$username = $this->input->post("username");
			$user_type = $this->input->post("user_type");
			$password = $this->input->post("new_password") == "" ? $this->input->post("password")  : md5($this->input->post("new_password")) ;
			$active = $this->input->post("active");

			$this->user_model->update($username, $user_type, $active, $password, $id);

			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;
		}
		$this->data["user"] = $this->user_model->select_by_id($id);
		$this->template_data["content"] = $this->load->view("user_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}	

	public function logout() {
		$this->session->sess_destroy();
		redirect("user/login");
	}
}
