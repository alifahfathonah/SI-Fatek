<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends CI_Controller {

	private $layout = 'layout/dosen';

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('login/dosen'));
		}
		
	}
	
	public function index() {

		$data['pageTitle'] = "Publikasi";
		$data['body_page'] = 'body_dosen/publikasi';

		$data['dosen'] = $this->Tabel_dosen->detail(array('nip'=> $this->session->userdata['logged_in_dosen']['nip']));

		$data['publikasi'] = $this->Tabel_publikasi->get($data['dosen']['dosenId']);
		$this->load->view($this->layout,$data);

	}
	
	public function edit() {

	}
	
	public function add_pub() {
	

	}
	
	public function delete_pub($id_pub) {
		

	}	
	
}