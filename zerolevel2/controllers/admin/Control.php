<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is admin *//
		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login')."?redirect=".uri_string());
			} else {
				show_error('Access denied!');
			}
		}

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['dosen']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['dosen']['userid'],
		);	
		
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