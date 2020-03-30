<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if ($this->session->userdata['logged_in_portal']['admin']['grup'] != 'admin') {
			show_error('Access Denied');
		}
		
	}

	public function index() {

		$data['pageTitle'] 	= "Kelola Aplikasi";
		$data['menu_page']	= "menu/admin";
		$data['body_page'] 	= "body/admin/control";

		$this->load->view(THEME,$data);
	}

	public function clear_cache() {

		$this->output->delete_cache('fakultas/dashboard');

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Cache files deleted!');

		redirect(site_url('admin/control'));

	}		

}