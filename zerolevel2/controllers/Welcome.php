<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();		
	}
	
	public function index() {
	
		$this->data['jlh_mahasiswa'] = 13416;
		$this->data['jlh_dosen'] = 195;

		$this->view = "welcome";
		$this->load->view($this->view,$this->data);
	
	}
	
}