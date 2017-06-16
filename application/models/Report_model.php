<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	
	public function select_troubleshoot_per_day($start_date, $end_date) {
		$sql = "
			SELECT 
				ACTION_DATE, DATE_FORMAT(ACTION_DATE, '%d') DAY,
				MAX(IF(TYPE = 'EVENT',TOTAL, 0)) EVENT_TOTAL, MAX(IF(TYPE = 'SOLVED', TOTAL, 0))  SOLVED_TOTAL
			FROM (
				SELECT EVENT_DATE ACTION_DATE, 'EVENT' TYPE, COUNT(ID) TOTAL
				FROM ASSET_TROUBLESHOOT WHERE EVENT_DATE BETWEEN STR_TO_DATE(?, '%Y-%m-%d') AND STR_TO_DATE(?, '%Y-%m-%d') 
				GROUP BY EVENT_DATE
				UNION
				SELECT SOLVED_DATE ACTION_DATE, 'SOLVED' TYPE, COUNT(ID) TOTAL
				FROM ASSET_TROUBLESHOOT WHERE EVENT_DATE BETWEEN STR_TO_DATE(?, '%Y-%m-%d') AND STR_TO_DATE(?, '%Y-%m-%d')
				GROUP BY SOLVED_DATE
			) A
			GROUP BY ACTION_DATE, DATE_FORMAT(ACTION_DATE, '%d')";
		$result = $this->db->query($sql, array($start_date, $end_date, $start_date, $end_date));
		return $result->result_array();
	}

	public function select_maintenance_per_day($start_date, $end_date) {
		$sql = "
			SELECT 
				EVENT_DATE, DATE_FORMAT(EVENT_DATE, '%d') DAY, COUNT(ID) TOTAL 
			FROM ASSET_MAINTENANCE 
			WHERE EVENT_DATE BETWEEN STR_TO_DATE(?, '%Y-%m-%d') AND STR_TO_DATE(?, '%Y-%m-%d')
		";
		$result = $this->db->query($sql, array($start_date, $end_date));
		return $result->result_array();
	}

	public function select_upcoming_per_organic($period) {
		$sql = "
			SELECT 
				USER_ID, USERNAME, 
				MAX(IF(STATUS = 'DONE', TOTAL, 0)) DONE_TOTAL,
				MAX(IF(STATUS = 'PENDING', TOTAL, 0)) PENDING_TOTAL,
				MAX(IF(STATUS = 'WAITING REMINDER', TOTAL, 0)) WAITING_REMINDER_TOTAL
			FROM ( 
				SELECT 
					B.ID USER_ID, USERNAME, STATUS, COUNT(STATUS) TOTAL
				FROM ASSET_UPCOMING_EVENT A
				JOIN USER B ON(A.USER_ID = B.ID)
				WHERE DATE_FORMAT(REMINDER_DATE, '%Y-%m') = ? AND USER_TYPE = 'ORGANIC'
				GROUP BY B.ID, USERNAME, STATUS
			) A
			GROUP BY USER_ID, USERNAME";
		$result = $this->db->query($sql, array($period));
		return $result->result_array();
	}

	public function select_activity_per_organic($period) {
		$sql = "
			SELECT 
				USER_ID, USERNAME, 
				MAX(IF(STATUS = 'TROUBLESHOOT_SOLVED', TOTAL, 0)) TROUBLESHOOT_SOLVED_TOTAL,
				MAX(IF(STATUS = 'TROUBLESHOOT', TOTAL, 0)) TROUBLESHOOT_TOTAL,
				MAX(IF(STATUS = 'MAINTENANCE', TOTAL, 0)) MAINTENANCE_TOTAL,
				MAX(IF(STATUS = 'UPCOMING', TOTAL, 0)) UPCOMING_TOTAL
			FROM ( 
				SELECT 
					USER_ID, COUNT(ID) TOTAL, 'TROUBLESHOOT' STATUS 
				FROM ASSET_TROUBLESHOOT 
				WHERE DATE_FORMAT(EVENT_DATE, '%Y-%m') = ?   
				GROUP BY USER_ID
				UNION
				SELECT 
					USER_ID_SOLVED USER_ID, COUNT(ID) TOTAL, 'TROUBLESHOOT_SOLVED' STATUS 
				FROM ASSET_TROUBLESHOOT 
				WHERE DATE_FORMAT(SOLVED_DATE, '%Y-%m') = ?
				GROUP BY USER_ID
				UNION
				SELECT 
					USER_ID, COUNT(ID) TOTAL, 'MAINTENANCE' STATUS 
				FROM ASSET_MAINTENANCE 
				WHERE DATE_FORMAT(EVENT_DATE, '%Y-%m') = ?
				GROUP BY USER_ID
				UNION
				SELECT 
					USER_ID, COUNT(ID) TOTAL, 'UPCOMING' STATUS 
				FROM ASSET_UPCOMING_EVENT 
				WHERE DATE_FORMAT(REMINDER_DATE, '%Y-%m') = ?
				GROUP BY USER_ID
			) A
			JOIN USER B ON(A.USER_ID = B.ID AND 'ORGANIC' = B.USER_TYPE)
			GROUP BY USER_ID, USERNAME";
		$result = $this->db->query($sql, array($period, $period, $period, $period));
		return $result->result_array();
	}	
}
?>