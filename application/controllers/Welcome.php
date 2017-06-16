<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function not_found()
	{
		$this->load->view('page_404');
	}
	
	public function internal_error()
	{
		$this->load->view('page_500');
	}

	public function alert_telegram(){
		$this->load->model("welcome_model");
		$result = $this->welcome_model->select_reminder_asset();
		foreach($result as $row) {
			if($row["INFO"] == "EXPIRED") {
				if($row["EXPIRED_MAINTENANCE_DATE"] == $row["ALERT_DATE"]) {
					$info = "Maintenance Habis";
				}
				if($row["END_OF_SALE_DATE"] == $row["ALERT_DATE"]) {
					$info = "End of Sale";
				}
				if($row["END_OF_LIFE_DATE"] == $row["ALERT_DATE"]) {
					$info = "End of Life";
				}
				if($row["END_OF_SUPPORT_DATE"] == $row["ALERT_DATE"]) {
					$info = "End of Support";
				}
				$text = "<b>".$info."</b>".chr(10).$row["BRAND"]." ".$row["TYPE"]." [ ".$row["HOSTNAME"]." / ".$row["IP_ADDRESS"]." ]".chr(10).chr(10)."Mohon Persiapkan Ijin Prinsip atau yang lainnya";
			}
			else {
				$text = "<b>Schedule Terjadwal untuk ".$row["USERNAME"]."</b>".chr(10)."Perihal : ".$row["DESCRIPTION"];
			}

			// send to server telegram
			$data = array(
				"text" => $text,
				"chat_id" => 100230,
				"parse_mode" => "HTML"
				);
			$ch = curl_unit();
			curl_setopt($ch, CURLOPT_URL, "172.18.104.79/customercare/welcome/public_send_telegram");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			
			$server_output = curl_exec($ch);
			curl_close($ch);
		}
	}
}
