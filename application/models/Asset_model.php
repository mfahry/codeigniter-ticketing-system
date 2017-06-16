<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_model extends CI_Model {
	public function select_all() {
		$sql = "
			SELECT 
				A.ID, BRAND, TYPE, B.NAME AS 'GROUP', LOCATION, 
				HOSTNAME, IP_ADDRESS, ACTIVE, OPERATING_SYSTEM 
			FROM ASSET A
			JOIN ASSET_GROUP B ON(A.GROUP_ID = B.ID)";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function insert(
		$hostname, $brand, $type, $ip_address, $location, $operating_system, $serial_number, $group_id, $active, $photo,
		$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
		$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $user_id, $port, 
		$end_of_support_date ) {

		$sql = "
			INSERT INTO ASSET (
				HOSTNAME, BRAND, TYPE, IP_ADDRESS, LOCATION, OPERATING_SYSTEM, SERIAL_NUMBER, GROUP_ID, ACTIVE, PHOTO,
				BUY_PRICE, BUY_DATE, EXPIRED_MAINTENANCE_DATE, END_OF_SALE_DATE, END_OF_LIFE_DATE, CABLE_TYPE,
				CABLE_X_COORDINATE, CABLE_Y_COORDINATE, HA_MODE, ASSET_FUNCTION, SPECIFICATION, USER_ID, PORT,
				END_OF_SUPPORT_DATE
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?, ?
			)";
		$this->db->query($sql, array(
			$hostname, $brand, $type, $ip_address, $location, $operating_system, $serial_number, $group_id, $active, $photo,
			$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
			$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $user_id, $port,
			$end_of_support_date
		));	

		return $this->db->insert_id();
	}

	public function update(
		$hostname, $brand, $type, $ip_address, $location, $operating_system, $serial_number, $group_id, $active, $photo,
		$buy_price, $buy_date, $expired_maintenance_date, $end_of_sale_date, $end_of_life_date, $cable_type,
		$cable_x_coordinate, $cable_y_coordinate, $ha_mode, $asset_function, $specification, $last_update_user_id, $port, 
		$end_of_support_date, $id) {

		$sql = "
			UPDATE ASSET SET 
				HOSTNAME = ?, BRAND = ?, TYPE = ?, IP_ADDRESS = ?, LOCATION = ?, OPERATING_SYSTEM = ?, SERIAL_NUMBER = ?,
				GROUP_ID = ?, ACTIVE = ?, PHOTO = ?, BUY_PRICE = ?, BUY_DATE = ?, EXPIRED_MAINTENANCE_DATE = ?, 
				END_OF_SALE_DATE = ?, END_OF_LIFE_DATE = ?, CABLE_TYPE = ?, CABLE_X_COORDINATE = ?, CABLE_Y_COORDINATE = ?,
				HA_MODE = ?, ASSET_FUNCTION = ?, SPECIFICATION = ?, LAST_UPDATE = NOW(), LAST_UPDATE_USER_ID = ?, PORT = ?,
				END_OF_SUPPORT_DATE = ?
			WHERE ID = ? ";
		
		$this->db->query($sql, array(
			$hostname, $brand, $type, $ip_address, $location, $operating_system, $serial_number, 
			$group_id, $active, $photo, $buy_price, $buy_date, $expired_maintenance_date, 
			$end_of_sale_date, $end_of_life_date, $cable_type, $cable_x_coordinate, $cable_y_coordinate, 
			$ha_mode, $asset_function, $specification, $last_update_user_id, $port, $end_of_support_date,
			$id
		));	
	}

	public function delete($id){
		$sql = "DELETE FROM ASSET WHERE ID = ?";
		$this->db->query($sql, array($id));
	}

	public function insert_port($asset_id, $port, $ip_address){
		$sql = "INSERT INTO ASSET_PORT(ASSET_ID, PORT, IP_ADDRESS) VALUES (?, ?, ?)";
		$this->db->query($sql, array($asset_id, $port, $ip_address));
	}

	public function delete_port_by_asset_id($asset_id){
		$sql = "DELETE FROM ASSET_PORT WHERE ASSET_ID = ?";
		$this->db->query($sql, array($asset_id));
	}

	public function insert_document($asset_id, $tmp_name, $tmp_description, $path){
		$sql = "INSERT INTO ASSET_DOCUMENT(ASSET_ID, NAME, DESCRIPTION, PATH) VALUES (?, ?, ?, ?)";
		$this->db->query($sql, array($asset_id, $tmp_name, $tmp_description, $path));
	}

	public function delete_document_by_asset_id($asset_id){
		$sql = "DELETE FROM ASSET_DOCUMENT WHERE ASSET_ID = ?";
		$this->db->query($sql, array($asset_id));	
	}

	public function select_by_id($id){
		$sql = "
			SELECT 
				A.ID, BRAND, TYPE, B.ID GROUP_ID, B.NAME GROUP_NAME, BUY_DATE, EXPIRED_MAINTENANCE_DATE, PHOTO, LOCATION,
				BUY_PRICE, CABLE_X_COORDINATE, CABLE_Y_COORDINATE, CABLE_TYPE, SERIAL_NUMBER, HA_MODE, SPECIFICATION,
				ASSET_FUNCTION, ACTIVE, HOSTNAME, END_OF_LIFE_DATE, END_OF_SALE_DATE, IP_ADDRESS, OPERATING_SYSTEM, PORT,
				END_OF_SUPPORT_DATE
			FROM ASSET A
			JOIN ASSET_GROUP B ON(A.GROUP_ID = B.ID)
			WHERE A.ID = ? ";
		$result = $this->db->query($sql, array($id));
		return $result->row_array();
	}

	public function select_port_by_asset_id($asset_id){
		$sql = "SELECT ID, PORT, IP_ADDRESS, ASSET_ID FROM ASSET_PORT WHERE ASSET_ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}

	public function select_document_by_asset_id($asset_id){
		$sql = "SELECT ID, ASSET_ID, NAME, PATH, DESCRIPTION FROM ASSET_DOCUMENT WHERE ASSET_ID = ?";
		$result = $this->db->query($sql, array($asset_id));
		return $result->result_array();
	}
}
?>