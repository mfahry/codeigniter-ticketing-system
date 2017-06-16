<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_group_model extends CI_Model {
	public function select_all()
	{
		$sql = "SELECT ID, NAME FROM ASSET_GROUP";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
}
?>