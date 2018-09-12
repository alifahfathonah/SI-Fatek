<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();

		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			redirect(site_url('login/dosen'));
		}
		
	}
	
	public function index() {

		$data['pageTitle'] 	= "Dashboard";
		$data['body_page'] 	= "body/dosen/dashboard";
		$data['menu_page']  = "menu/dosen";
		
		$this->load->view(SITE_THEME,$data);

	}
	
}