<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			redirect(site_url('login/dosen'));
		}
		
	}
	
	public function index() {

		$data['pageTitle'] 	= "Publikasi Dosen";
		$data['body_page'] 	= "body/dosen/publikasi";
		$data['menu_page'] 	= "menu/dosen";

		$dosenNip 			= $this->session->userdata['logged_in_portal']['dosen']['nip'];
		$data['dosen'] 		= $this->Tabel_dosen->detail(array('nip'=> $dosenNip));
		$data['publikasi'] 	= $this->Tabel_publikasi->get(array('dosenId'=> $data['dosen']['dosenId']),'tahun DESC');

		$this->load->view(SITE_THEME,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('jurnal', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['dosenId']= $this->input->post('dosenId');
			$database['judul']	= $this->input->post('judul');
			$database['di'] 	= $this->input->post('jurnal');
			$database['tempat'] = $this->input->post('tempat');
			$database['tahun'] 	= $this->input->post('tahun');
			$this->Tabel_publikasi->tambah($database);
			
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil di simpan!');			

		} else {

			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors('Gagal di simpan! '));
		}

		redirect(site_url('dosen/publikasi'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('jurnal', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['dosenId']	= $this->input->post('dosenId');
			$database['judul']		= $this->input->post('judul');
			$database['di'] 		= $this->input->post('jurnal');
			$database['tempat'] 	= $this->input->post('tempat');
			$database['tahun'] 		= $this->input->post('tahun');
			$database['publikasiId']= $this->input->post('publikasiId');
			$this->Tabel_publikasi->update($database);
			
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil di simpan!');

		} else {

			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors('Gagal di simpan! '));
		}

		redirect(site_url('dosen/publikasi'));
	
	}	
	
	public function delete() {

		$id_publikasi 	= $this->input->post('id');
		$response 		= $this->Tabel_publikasi->delete($id_publikasi);

		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('message', 'Berhasil di hapus!');

	}

	public function detail($id) {

		$output = $this->Tabel_publikasi->detail(array('publikasiId'=> $id));
		echo json_encode($output);

	}
	
}