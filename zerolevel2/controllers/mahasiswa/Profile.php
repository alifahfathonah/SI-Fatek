<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if (!isset($this->session->userdata['logged_in_portal']['mhs'])) {
			redirect(site_url('login/mahasiswa'));
		}
		
	}

	public function index() {
		
		$data['pageTitle']	= "Profile Mahasiswa";
		$data['body_page'] 	= "body/mahasiswa/profile";
		$data['menu_page'] 	= "menu/mahasiswa";

		$mhsNim 			= $this->session->userdata['logged_in_portal']['mhs']['nim'];
		$data['mhs'] 		= $this->apicall->get(URL_API.'mahasiswa?nim='.$mhsNim);

		$this->load->view(THEME_MHS,$data);
	}

}