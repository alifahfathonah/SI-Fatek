<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('Data_model', 'Dosen_model', 'Pendidikan_model', 'Publikasi_model'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('dosen/login'));
		}
		$this->data['pageTitle'] = "Bimbingan Skripsi";
		$this->view = 'layout/dosen';
		
	}

	public function index() {
		
		$this->data['body_page'] = 'body_dosen/pembimbingan';
		$this->load->view($this->view,$this->data);

	}
}