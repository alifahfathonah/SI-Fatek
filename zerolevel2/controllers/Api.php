<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is logged user *//
		if (!isset($this->session->userdata['logged_in_portal'])) {
			redirect(site_url('login'));
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_announce', 'Tabel_dosen', 'Tabel_pegawai')); 

	}

	public function list_pegawai() {

		$output = $this->Tabel_pegawai->get_pegawai("nip AS id, nama");

		echo json_encode($output);
	
	}

	public function detail_pegawai($id) {

		$output = $this->Tabel_pegawai->get_pegawai("nip AS id, nama",array('nip' => $id));

		echo json_encode($output);
	
	}

}