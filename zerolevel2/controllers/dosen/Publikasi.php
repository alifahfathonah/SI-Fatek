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
		$data['body_page'] 	= "body/publikasi/list";
		$data['menu_page'] 	= "menu/dosen";

		$dosenNip 			= $this->session->userdata['logged_in_portal']['dosen']['nip'];
		$data['dosen'] 		= $this->Tabel_dosen->detail(array('nip'=> $dosenNip));
		$data['publikasi'] 	= $this->Tabel_publikasi->get(array('dosenNip'=> $dosenNip),'tahun DESC');

		$this->load->view(THEME_DOSEN,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('jurnal', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['dosenNip']	= $this->input->post('nip');
			$database['judul']		= $this->input->post('judul');
			$database['di'] 		= $this->input->post('jurnal');
			$database['tempat'] 	= $this->input->post('tempat');
			$database['tahun'] 		= $this->input->post('tahun');
			
			if ($this->Tabel_publikasi->tambah($database)) {

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil disimpan!');	

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal disimpan!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('dosen/publikasi'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('jurnal', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['publikasiId']= $this->input->post('id');
			$database['dosenNip']	= $this->input->post('nip');
			$database['judul']		= $this->input->post('judul');
			$database['di'] 		= $this->input->post('jurnal');
			$database['tempat'] 	= $this->input->post('tempat');
			$database['tahun'] 		= $this->input->post('tahun');
			$database['userUpdate']	= $this->session->userdata['logged_in_portal']['nama'];
			
			if ($this->Tabel_publikasi->update($database)) {
				
				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil diupdate!');

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal diupdate!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('dosen/publikasi'));
	
	}	
	
	public function delete() {

		$id_publikasi 	= $this->input->post('id');

		if ($this->Tabel_publikasi->delete($id_publikasi)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id) {

		$output = $this->Tabel_publikasi->detail(array('publikasiId'=> $id));
		echo json_encode($output);

	}
	
}