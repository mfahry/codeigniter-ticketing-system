<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {
	public function select_all() {
		$sql = "
			SELECT A.ID, ASSET_ID, HOSTNAME, IP_ADDRESS, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH
			FROM ASSET_MAINTENANCE A
			JOIN ASSET B ON(A.ASSET_ID = B.ID)";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert($asset_id, $event_date, $description, $document_path, $user_id){
		$sql = "
			INSERT INTO ASSET_MAINTENANCE(ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH, USER_ID) VALUES (?, ?, ?, ?, ?)";
		$this->db->query($sql, array($asset_id, $event_date, $description, $document_path, $user_id));
	}

	public function update($asset_id, $event_date, $description, $document_path, $id){
		$sql = "
			UPDATE ASSET_MAINTENANCE SET 
				ASSET_ID = ?,  EVENT_DATE = ?,  DESCRIPTION = ?, DOCUMENT_PATH = ?
			WHERE ID = ?";
		$this->db->query($sql, array(
			$asset_id, $event_date, $description, $document_path, 
			$id));
	}

	public function delete($id){
		$sql = "DELETE FROM ASSET_MAINTENANCE WHERE ID = ?";
		$this->db->query($sql, array($id));
	}

	public function select_by_asset_id($asset_id){
		$sql = "SELECT ID, ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH FROM ASSET_MAINTENANCE WHERE ASSET_ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}

	public function select_by_id($id){
		$sql = "SELECT ID, ASSET_ID, EVENT_DATE, DESCRIPTION, DOCUMENT_PATH FROM ASSET_MAINTENANCE WHERE ID = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}

}
?>