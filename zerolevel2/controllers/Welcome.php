<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();		
	}
	
	public function index() {
	
		$data['jlh_mahasiswa'] = 13416;
		$data['jlh_dosen'] = 195;

		$this->load->view("welcome",$data);
	
	}
	
}