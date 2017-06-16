<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Troubleshoot_model extends CI_Model {
	public function select_all() {
		$sql = "
			SELECT 
				A.ID, ASSET_ID, HOSTNAME, IP_ADDRESS, EVENT_DATE, 
				DESCRIPTION, TROUBLESHOOT, SOLVED, DOCUMENT_PATH, A.USER_ID, C.USERNAME,
				USER_ID_SOLVED, D.USERNAME USERNAME_SOLVED, SOLVED_DATE
			FROM ASSET_TROUBLESHOOT A
			JOIN ASSET B ON(A.ASSET_ID = B.ID)
			JOIN USER C ON(A.USER_ID = C.ID)
			LEFT JOIN USER D ON(A.USER_ID_SOLVED = D.ID)";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert(
		$asset_id, $event_date, $description, $solved_date, $troubleshoot, $solved,
		$user_id, $user_id_solved, $document_path) {

		$sql = "
			INSERT INTO ASSET_TROUBLESHOOT (
				ASSET_ID, EVENT_DATE, DESCRIPTION, SOLVED_DATE, TROUBLESHOOT, 
				SOLVED, USER_ID, USER_ID_SOLVED, DOCUMENT_PATH
			) VALUES (
				?, ?, ?, ?, ?,
				?, ?, ?, ?
			)";
		$this->db->query($sql, array(
			$asset_id, $event_date, $description, $solved_date, $troubleshoot, 
			$solved, $user_id, $user_id_solved, $document_path));
	}

	public function update(
		$asset_id, $event_date, $description, $solved_date, $troubleshoot, $solved,
		$user_id_solved, $document_path, $id) {

		$sql = "
			UPDATE ASSET_TROUBLESHOOT SET
				ASSET_ID = ?, EVENT_DATE = ?, DESCRIPTION = ?, SOLVED_DATE = ?, TROUBLESHOOT = ?, 
				SOLVED = ?, USER_ID_SOLVED = ?, DOCUMENT_PATH = ?
			WHERE ID = ?";
		$this->db->query($sql, array(
			$asset_id, $event_date, $description, $solved_date, $troubleshoot, 
			$solved, $user_id_solved, $document_path,
			$id));
	}

	public function delete($id){
		$sql = "DELETE FROM ASSET_TROUBLESHOOT WHERE ID = ?";
		$this->db->query($sql, array($id));
	}
	
	public function select_by_asset_id($asset_id){
		$sql = "
			SELECT 
				ID, ASSET_ID, EVENT_DATE, DESCRIPTION, TROUBLESHOOT, SOLVED, 
				DOCUMENT_PATH, SOLVED_DATE, USER_ID, USER_ID_SOLVED, DOCUMENT_PATH 
			FROM ASSET_TROUBLESHOOT
			WHERE ASSET_ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}

	public function select_by_id($id){
		$sql = "
			SELECT 
				ID, ASSET_ID, EVENT_DATE, DESCRIPTION, TROUBLESHOOT, SOLVED, 
				DOCUMENT_PATH, SOLVED_DATE, USER_ID, USER_ID_SOLVED, DOCUMENT_PATH 
			FROM ASSET_TROUBLESHOOT
			WHERE ID = ?";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}
}
?>