<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is logged user *//
		if (!isset($this->session->userdata['logged_in_portal'])) {
			redirect(site_url('login'));
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_xNotifikasi')); 

	}

	public function index() {


	}

	public function get_notif() {

		$id = $this->session->userdata['logged_in_portal']['desc'];
		$data['notif']	= $this->Tabel_xNotifikasi->get("*",array('toUser' => $id, 'unread' => '1'),'tglNotif DESC');
		$data['jumlah'] = count($data['notif']);

		foreach ($data['notif'] as &$val) {
			$val['link'] = site_url($val['link']);
			
		}
		echo json_encode($data);
	}

	public function set_read($id) {

		//*Set Read in database *//
		$this->Tabel_xNotifikasi->set_read($id);
		
	}

}