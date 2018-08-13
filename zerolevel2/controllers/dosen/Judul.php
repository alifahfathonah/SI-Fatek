<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_judul','Tabel_labstudio'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('dosen/login'));
		}

		$this->view = 'layout/dosen';
		
	}

	public function index() {
		
		$this->data['judul'] = $this->Tabel_judul->get(array('dosenPengusul'=> $this->session->userdata['logged_in_dosen']['nip']),'tglUsul DESC');
		$this->data['labstudio'] = $this->Tabel_labstudio->get(array('labstudioJurKode'=> $this->session->userdata['logged_in_dosen']['kodeJur']));
		$this->data['body_page'] = 'body_dosen/usulan_judul';

		//echo var_dump($this->data);
		$this->load->view($this->view,$this->data);


	}

	public function tambah() {
		
		$database['judulTa'] 		= $this->input->post('judul');
		$database['dosenPengusul'] 	= $this->session->userdata['logged_in_dosen']['nip'];
		$database['kodeLabStudio'] 	= $this->input->post('labstudio');
		$database['keyword'] 		= $this->input->post('tags');
		$database['tglUsul'] 		= date("Y-m-d");

		$this->Tabel_judul->tambah($database);
		redirect(site_url('dosen/judul'));

	}

		public function detail() {
		
		$data = $this->Tabel_judul->detail('idJudul = 5');

		$this->load->view('debug',$data);

	}
}