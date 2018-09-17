<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login'));
		}
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Dashboard";
		$data['body_page'] 	= "body/dekan/dashboard";
		$data['menu_page'] 	= "menu/dekan";
		
		$this->load->view(THEME_ADMIN,$data);
	}

}