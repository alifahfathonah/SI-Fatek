<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_judul','Tabel_labstudio'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('login/dosen'));
		}
		$this->view = 'layout/dosen';
		$this->data['pageTitle'] = "Judul Skripsi";
		
	}

	public function index() {
		
		$this->data['judul'] = $this->Tabel_judul->get(array('judulDsnPengusul'=> $this->session->userdata['logged_in_dosen']['nip']),'judulTglUsul DESC');
		$this->data['labstudio'] = $this->Tabel_labstudio->get(array('labstudioJurKode'=> $this->session->userdata['logged_in_dosen']['kodeJur']));
		$this->data['body_page'] = 'body_dosen/usulan_judul';

		$this->load->view($this->view,$this->data);

	}

	public function tambah() {

		$this->form_validation->set_rules('judul', 'Judul Proposal', 'trim|required');

		if ($this->form_validation->run() == TRUE) {

			$database['judulTa'] 			= $this->input->post('judul');
			$database['judulDsnPengusul'] 	= $this->session->userdata['logged_in_dosen']['nip'];
			$database['judulLabstudioId'] = $this->input->post('labstudio');
			$database['judulKeyword'] 		= $this->input->post('keyword');
			$database['judulKodeProdi'] 	= $this->session->userdata['logged_in_dosen']['kodeProdi'];
			$database['judulTglUsul'] 		= date("Y-m-d");

			$this->Tabel_judul->tambah($database);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil di simpan!');

		} else {
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors('Gagal tambah judul! '));
		}

		redirect(site_url('dosen/judul'));

	}

	public function edit() {

		$this->form_validation->set_rules('judul', 'Judul Proposal', 'trim|required');

		if ($this->form_validation->run() == TRUE) {		
			$database['judulId'] 			= $this->input->post('idJudul');
			$database['judulTa'] 			= $this->input->post('judul');
			$database['judulLabstudioId'] = $this->input->post('labstudio');
			$database['judulKeyword'] 		= $this->input->post('keyword');

			$this->Tabel_judul->update($database);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil di simpan!');

		} else {
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors('Gagal edit judul! '));
		}	

		redirect(site_url('dosen/judul'));

	}

	public function detail($id) {
		$output = $this->Tabel_judul->detail(array('judulId'=> $id));
		echo json_encode($output);

	}

	public function delete() {
		$id = $this->input->post('judulId');
		$response = $this->Tabel_judul->delete($id);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Berhasil di hapus!');

	}
}