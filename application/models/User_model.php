<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function select_by_username_password($username, $password) {
		$sql = "SELECT ID, USERNAME, USER_TYPE, ACTIVE FROM USER WHERE USERNAME = ? AND PASSWORD = MD5(?)";
		$result = $this->db->query($sql, array($username, $password));

		if($result->row_array() != null) {
			$user = $result->row_array();

			$sql = "UPDATE USER SET LAST_LOGIN = NOW() WHERE ID = ?";
			$this->db->query($sql, array($user["ID"]));
		}
		return $result->row_array();
	}

	public function select_all($sys = false) {
		if(!$sys){
			$sql = "SELECT ID, USERNAME, USER_TYPE, LAST_LOGIN, ACTIVE FROM USER WHERE ACTIVE = 'Y'";
		}
		else {
			$sql = "SELECT ID, USERNAME, USER_TYPE, LAST_LOGIN, ACTIVE FROM USER";
		}
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function select_by_id($id) {
		$sql = "SELECT ID, USERNAME, PASSWORD, USER_TYPE, LAST_LOGIN, ACTIVE FROM USER WHERE ID = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}

	public function select_by_user_type($user_type) {
		$sql = "SELECT ID, USERNAME, USER_TYPE, LAST_LOGIN, ACTIVE FROM USER WHERE USER_TYPE = ?";
		$result = $this->db->query($sql, array($user_type));
		return $result->result_array();
	}

	public function insert($username, $user_type, $active, $password) {
		$sql = "INSERT INTO USER (USERNAME, USER_TYPE, ACTIVE, PASSWORD) VALUES (?, ?, ?, ?)";
		$result = $this->db->query($sql, array($username, $user_type, $active, $password));
	}

	public function update($username, $user_type, $active, $password, $id) {
		$sql = "UPDATE USER SET USERNAME = ?,  USER_TYPE = ?,  ACTIVE = ?, PASSWORD = ? WHERE ID = ?";
		$result = $this->db->query($sql, array($username, $user_type, $active, $password, $id));
	}
}
?>