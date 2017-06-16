<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upcoming_model extends CI_Model {
	public function select_all() {
		$sql = "
			SELECT 
				A.ID, ASSET_ID, HOSTNAME, IP_ADDRESS, REMINDER_DATE, 
				DESCRIPTION, A.USER_ID, STATUS
			FROM ASSET_UPCOMING_EVENT A
			JOIN ASSET B ON(A.ASSET_ID = B.ID)
			JOIN USER C ON(A.USER_ID = C.ID)";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert($asset_id, $reminder_date, $description, $status, $user_id) {

		$sql = "
			INSERT INTO ASSET_UPCOMING_EVENT (
				ASSET_ID, REMINDER_DATE, DESCRIPTION, STATUS, USER_ID
			) VALUES (
				?, ?, ?, ?, ?
			)";
		$this->db->query($sql, array($asset_id, $reminder_date, $description, $status, $user_id));
	}

	public function update($asset_id, $reminder_date, $description, $status, $id) {

		$sql = "
			UPDATE ASSET_UPCOMING_EVENT SET
				ASSET_ID = ?, REMINDER_DATE = ?, DESCRIPTION = ?, STATUS = ?
			WHERE ID = ?";
		$this->db->query($sql, array(
			$asset_id, $reminder_date, $description, $status, 
			$id));
	}

	public function delete($id){
		$sql = "DELETE FROM ASSET_UPCOMING_EVENT WHERE ID = ?";
		$this->db->query($sql, array($id));
	}
	
	public function select_by_asset_id($asset_id){
		$sql = "
			SELECT 
				ID, ASSET_ID, REMINDER_DATE, DESCRIPTION, STATUS 
			FROM ASSET_UPCOMING_EVENT WHERE ASSET_ID = ? 
			ORDER BY REMINDER_DATE DESC
			LIMIT 0,10";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}

	public function select_by_id($id){
		$sql = "SELECT ID, ASSET_ID, REMINDER_DATE, DESCRIPTION, STATUS FROM ASSET_UPCOMING_EVENT WHERE ID = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}
}
?>