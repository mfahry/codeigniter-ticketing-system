<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	public function asset_availability_per_group(){
		$sql = "
			SELECT 
				A.ID GROUP_ID, A.NAME GROUP_NAME, 
				IFNULL(SUM(IF(ACTIVE = 'Y', 1, 0)),0) ACTIVE, IFNULL(SUM(IF(ACTIVE = 'N', 1, 0)),0) NON_ACTIVE
			FROM ASSET_GROUP A
			LEFT JOIN  ASSET B ON(A.ID = B.GROUP_ID)
			GROUP BY A.ID, A.NAME";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function maintenance_total_per_month($date){
		$sql = "SELECT COUNT(ID) TOTAL FROM ASSET_MAINTENANCE WHERE DATE_FORMAT(EVENT_DATE, '%Y-%m') = ?";
		$result = $this->db->query($sql, array($date));
		return $result->row_array();
	}

	public function troubleshoot_total_per_month($date){
		$sql = "
			SELECT 
				SOLVED STATUS, COUNT(ID) TOTAL 
			FROM ASSET_TROUBLESHOOT 
			WHERE DATE_FORMAT(EVENT_DATE, '%Y-%m') = ?
			GROUP BY SOLVED";
		$result = $this->db->query($sql, array($date));
		return $result->result_array();		
	}

	public function procurement_total_per_month($date){
		$sql = "
			SELECT 
				STATUS, COUNT(ID) TOTAL 
			FROM ASSET_PROCUREMENT_MAINTENANCE 
			WHERE DATE_FORMAT(FILLING_DATE, '%Y-%m') = ? 
			GROUP BY STATUS";
		$result = $this->db->query($sql, array($date));
		return $result->result_array();		
	}

	public function latest_five_login(){
		$sql = "SELECT ID, USERNAME, LAST_LOGIN, USER_TYPE FROM USER ORDER BY LAST_LOGIN DESC LIMIT 5";
		$result = $this->db->query($sql);
		return $result->result_array();
	}	

	public function reminder_asset_critical_date($date){
		$sql = "
			SELECT 
				A.ID, B.NAME GROUP_NAME, BRAND, TYPE, IP_ADDRESS, LOCATION,
				HOSTNAME, EXPIRED_MAINTENANCE_DATE, END_OF_SALE_DATE, END_OF_LIFE_DATE
			FROM ASSET A
			JOIN ASSET_GROUP B ON(A.GROUP_ID = B.ID)
			WHERE DATE_FORMAT(EXPIRED_MAINTENANCE_DATE, '%Y-%m') = ? OR DATE_FORMAT(END_OF_SALE_DATE, '%Y-%m') = ? OR DATE_FORMAT(END_OF_LIFE_DATE, '%Y-%m') = ? OR DATE_FORMAT(END_OF_SUPPORT_DATE, '%Y-%m') = ?";
		$result = $this->db->query($sql, array($date, $date, $date, $date));
		return $result->result_array();
	}

	public function reminder_upcoming_event($date){
		$sql = "
			SELECT 
				A.ID, C.NAME GROUP_NAME, BRAND, TYPE, IP_ADDRESS, LOCATION,
				HOSTNAME, D.USERNAME, REMINDER_DATE, A.DESCRIPTION
			FROM ASSET_UPCOMING_EVENT A
			JOIN ASSET B ON(A.ASSET_ID = B.ID)
			JOIN ASSET_GROUP C ON(B.GROUP_ID = C.ID)
			JOIN USER D ON(A.USER_ID = D.ID)
			WHERE DATE_FORMAT(REMINDER_DATE, '%Y-%m') = ? AND STATUS IN('WAITING REMINDER', 'PENDING')";
		$result = $this->db->query($sql, array($date));
		return $result->result_array();
	}	
}
?>