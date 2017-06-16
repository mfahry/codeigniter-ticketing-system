<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends CI_Controller {

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
			$this->load->model("asset_model");
			$this->data["asset"] = $this->asset_model->select_all();

			$this->template_data["content"] = $this->load->view("asset_list", $this->data, TRUE);
			$this->load->view("template", $this->template_data); 
	}

	public function add() {

		//	add form has been executed 
		if($this->input->post()) {
			$this->load->model("asset_model");

			// insert new asset
			$hostname = $this->input->post("hostname"); 
			$brand = $this->input->post("brand");
			$type = $this->input->post("type");
			$ip_address = $this->input->post("ip_address");
			$location = $this->input->post("location");
			$operating_system = $this->input->post("operating_system");
			$serial_number = $this->input->post("serial_number");
			$group_id = $this->input->post("group_id");
			$active = empty($this->input->post("active")) ? "N":"Y";
			$buy_price = $this->input->post("buy_price");
			$buy_date = $this->input->post("buy_date");
			$expired_maintenance_date = $this->input->post("expired_maintenance_date");
			$end_of_sale_date = $this->input->post("end_of_sale_date");
			$end_of_life_date = $this->input->post("end_of_life_date");
			$cable_type = $this->input->post("cable_type");
			$cable_x_coordinate = $this->input->post("cable_x_coordinate");
			$cable_y_coordinate = $this->input->post("cable_y_coordinate");
			$ha_mode = $this->input->post("ha_mode");
			$asset_function = $this->input->post("asset_function");
			$specification = $this->input->post("specification");
			$user_id = $this->session->userdata("user")["id"];
			$port_asset = $this->input->post("port_asset");
			$end_of_support_date = $this->input->post("end_of_support_date");
			$photo = "";

			//	configuration upload
			$config["upload_path"] = "uploads/asset/";
			$config["allowed_types"] ="doc|docx|pdf|xls|xlsx|csv|ppt|pptx|pages|numbers|key";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			//	upload photo
			if($_FILES["photo"]["name"] != ""){
      	if($this->upload->do_upload("photo")){
      		$file = $this->upload->data();
      		$photo = $config['upload_path'].$file["file_name"];	
      	}
      	else{
      		$info = array(
    				"text" => $this->upload->display_errors(), 
    				"class" => "alert-danger");
      		$this->session->set_userdata("info", $info);
      		redirect("asset/add");
      	}
			}
			$asset_id = $this->asset_model->insert(
				$hostname, $brand, $type, $ip_address, $location, $operating_system, $serial_number, $group_id, $active, $photo,
				$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
				$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $user_id, $port_asset, 
				$end_of_support_date );

			// insert asset port opened
			if($asset_id != "" && $this->input->post("port")){
				$port = $this->input->post("port");
				$ip_address_port = $this->input->post("ip_address_port");

				for($i = 0; $i < count($port); $i++){
					$tmp_port = $port[$i];
					$tmp_ip_address = $ip_address_port[$i];
					$this->asset_model->insert_port($asset_id, $tmp_port, $tmp_ip_address);
				}
			}

			//upload document
			if($asset_id != "" && $this->input->post("document_name")){
				$name = $this->input->post("document_name");
				$description = $this->input->post("document_description");

				for($i = 0; $i < count($name); $i++){
					$tmp_name = $name[$i];
					$tmp_description = $description[$i];
					$path = "";
					
					if($_FILES["document_file"]["name"][$i] != ""){
						$_FILES["document"]["name"] = $_FILES["document_file"]["name"][$i];
						$_FILES["document"]["type"] = $_FILES["document_file"]["type"][$i];
						$_FILES["document"]["tmp_name"] = $_FILES["document_file"]["tmp_name"][$i];
						$_FILES["document"]["error"] = $_FILES["document_file"]["error"][$i];
						$_FILES["document"]["size"] = $_FILES["document_file"]["size"][$i];

						if($this->upload->do_upload("document")){
							$file = $this->upload->data();
							$path = $config['upload_path'].$file["file_name"];
						}
						else{
							$info = array(
		    				"text" => $this->upload->display_errors(), 
		    				"class" => "alert-danger");
		      		$this->session->set_userdata("info", $info);
      				redirect("asset/add");	
						}
					}

					//	insert document asset
					$this->asset_model->insert_document($asset_id, $tmp_name, $tmp_description, $path);
				}
			}
			$info = array(
				"text" => "data berhasil diinputkan ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;
		}

		$this->load->model("asset_group_model");
		$this->data["asset_group"] = $this->asset_group_model->select_all();

		$this->template_data["content"] = $this->load->view("asset_form", $this->data, TRUE);
		$this->load->view("template",$this->template_data);
	}

	public function detail($id){
		$this->load->model("asset_model");
		$this->load->model("troubleshoot_model");
		$this->load->model("maintenance_model");
		$this->load->model("upcoming_model");
		$this->load->model("procurement_model");

		$this->data["asset"] = $this->asset_model->select_by_id($id);
		$this->data["port"] = $this->asset_model->select_port_by_asset_id($id);
		$this->data["document"] = $this->asset_model->select_document_by_asset_id($id);
		$this->data["troubleshoot"] = $this->troubleshoot_model->select_by_asset_id($id);
		$this->data["maintenance"] = $this->maintenance_model->select_by_asset_id($id);
		$this->data["upcoming"] = $this->upcoming_model->select_by_asset_id($id);
		$this->data["procurement"] = $this->procurement_model->select_by_asset_id($id);

		$this->template_data["content"] = $this->load->view("asset_detail", $this->data, TRUE);
		$this->load->view("template", $this->template_data); 
	}

	public function modify($id){
		$this->load->model("asset_model");
		$this->load->model("asset_group_model");

		if($this->input->post()){
			// update asset			
			$hostname = $this->input->post("hostname"); 
			$brand = $this->input->post("brand");
			$type = $this->input->post("type");
			$ip_address = $this->input->post("ip_address");
			$location = $this->input->post("location");
			$operating_system = $this->input->post("operating_system");
			$serial_number = $this->input->post("serial_number");
			$group_id = $this->input->post("group_id");
			$active = empty($this->input->post("active")) ? "N":"Y";
			$buy_price = $this->input->post("buy_price");
			$buy_date = $this->input->post("buy_date");
			$expired_maintenance_date = $this->input->post("expired_maintenance_date");
			$end_of_sale_date = $this->input->post("end_of_sale_date");
			$end_of_life_date = $this->input->post("end_of_life_date");
			$cable_type = $this->input->post("cable_type");
			$cable_x_coordinate = $this->input->post("cable_x_coordinate");
			$cable_y_coordinate = $this->input->post("cable_y_coordinate");
			$ha_mode = $this->input->post("ha_mode");
			$asset_function = $this->input->post("asset_function");
			$specification = $this->input->post("specification");
			$port_asset = $this->input->post("port_asset");
			$end_of_support_date = $this->input->post("end_of_support_date");  
			$last_update_user_id = $this->session->userdata("user")["id"];
			$photo = $this->input->post("photo_old");

			//	configuration upload
			$config["upload_path"] = "uploads/asset/";
			$config["allowed_types"] ="doc|docx|pdf|xls|xlsx|csv|ppt|pptx|pages|numbers|key";
			$this->load->library("upload", $config);
			$this->upload->initialize($config);
			
			//	upload photo
			if($_FILES["photo"]["name"] != ""){
		      	if($this->upload->do_upload("photo")){
		      		//	delete old photo
		      		if($photo != ""){
		      			unlink("./".$photo);
		      		}
		      			
		      		//	upload new photo
		      		$file = $this->upload->data();
		      		$photo = $config['upload_path'].$file["file_name"];	
		      	}
		      	else{
		      		$info = array(
		    				"text" => $this->upload->display_errors(), 
		    				"class" => "alert-danger");
		      		$this->session->set_userdata("info", $info);
		      		redirect("asset/modify/".$id);
		      	}
			}
			
			$this->asset_model->update(
				$hostname, $brand, $type, $ip_address, $location, $operating_system, $serial_number, $group_id, $active, $photo,
				$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
				$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $last_update_user_id, 
				$port_asset, $end_of_support_date, $id );

			// update asset port opened
			$this->asset_model->delete_port_by_asset_id($id);
			if($this->input->post("port")){
				$port = $this->input->post("port");
				$ip_address_port = $this->input->post("ip_address_port");

				for($i = 0; $i < count($port); $i++){
					$tmp_port = $port[$i];
					$tmp_ip_address = $ip_address_port[$i];
					$this->asset_model->insert_port($id, $tmp_port, $tmp_ip_address);
				}
			}

			//update document
			$this->asset_model->delete_document_by_asset_id($id);
			if($this->input->post("document_name")){
				$name = $this->input->post("document_name");
				$description = $this->input->post("document_description");

				for($i = 0; $i < count($name); $i++){
					$tmp_name = $name[$i];
					$tmp_description = $description[$i];
					$path = isset($this->input->post("path_old")[$i]) ? $this->input->post("path_old")[$i] : "";
					
					if($_FILES["document_file"]["name"][$i] != ""){
						$_FILES["document"]["name"] = $_FILES["document_file"]["name"][$i];
						$_FILES["document"]["type"] = $_FILES["document_file"]["type"][$i];
						$_FILES["document"]["tmp_name"] = $_FILES["document_file"]["tmp_name"][$i];
						$_FILES["document"]["error"] = $_FILES["document_file"]["error"][$i];
						$_FILES["document"]["size"] = $_FILES["document_file"]["size"][$i];

						if($this->upload->do_upload("document")){
							// delete old document
							if($path != ""){
								unlink("./".$path);
							}
							$file = $this->upload->data();
							$path = $config['upload_path'].$file["file_name"];
						}
						else{
							$info = array(
		    				"text" => $this->upload->display_errors(), 
		    				"class" => "alert-danger");
		      		$this->session->set_userdata("info", $info);
      				redirect("asset/modify/".$id);	
						}
					}

					//	insert document asset
					$this->asset_model->insert_document($id, $tmp_name, $tmp_description, $path);
				}
			}
			$info = array(
				"text" => "data berhasil diupdate ke sistem", 
				"class" => "alert-success");
  		$this->data["info"] = $info;
		}

		$this->data["asset_group"] = $this->asset_group_model->select_all();
		$this->data["asset"] = $this->asset_model->select_by_id($id);
		$this->data["port"] = $this->asset_model->select_port_by_asset_id($id);
		$this->data["document"] = $this->asset_model->select_document_by_asset_id($id);
		
		$this->template_data["content"] = $this->load->view("asset_form_modify", $this->data, TRUE);
		$this->load->view("template", $this->template_data);
	}

	public function drop($id){
		$this->load->model("asset_model");
		$this->asset_model->delete($id);
		$info = array(
			"text" => "data berhasil dihapus dari sistem", 
			"class" => "alert-danger");
		$this->session->set_userdata("info", $info);
		redirect("asset");	
	}

	
	public function get_snmp_data() {
		//ini_set("display_errors", "off");
		
		/*$ip_address = $this->input->post("ip_address");
		$split_ip_address = explode(".", $ip_address);
		$ip_address = intval($split_ip_address[0]).".".intval($split_ip_address[1]).".".intval($split_ip_address[2]).".".intval($split_ip_address[3]);
		*/

		$ip_address = "127.0.0.1";
		if (! snmprealwalk($ip_address, "public", "")){
			echo "not found data";
		}
		else {
			//$this->data["snmp"] = snmprealwalk($ip_address, "public", "1.3.6.1.2.1.1");
			//$snmp_data = snmprealwalk($ip_address, "public", "");
			//print_r($snmp_data);
			
			//get memory 
			$this->data["memory"] = round(str_replace("INTEGER: ","",snmpwalk($ip_address, "public", ".1.3.6.1.2.1.25.2.2.0")[0]) / 1000000, 2);

			//get host
			$this->data["host"] = str_replace("STRING: ","",snmpwalk($ip_address, "public", ".1.3.6.1.2.1.1.1.0")[0]);
			
			//get storage
			$temp_storage_allocation = snmpwalk($ip_address, "public", ".1.3.6.1.2.1.25.2.3.1.4");
			$temp_storage_size = snmpwalk($ip_address, "public", ".1.3.6.1.2.1.25.2.3.1.5");
			$storage = 0;
			for($i = 0 ; $i < count($temp_storage_size); $i++) {
				$size = str_replace("INTEGER: ", "", $temp_storage_size[$i]);
				$allocation = str_replace("INTEGER: ", "", $temp_storage_allocation[$i]) /1000;
				$storage += $size * $allocation;
			}
			$this->data["storage"] = round($storage / 1000000, 2);

			$device = snmprealwalk($ip_address, "public", ".1.3.6.1.2.1.25.3.2.1.3");
			$specification = "";
			foreach($device as $row) {
				$specification .=str_replace("STRING: ", "", str_replace("\"", "",$row))."\n";
			}
			$this->data["specification"] = $specification;
			//print_r($this->data);

			$this->load->view("snmp_detail", $this->data);

		}
	}
}
