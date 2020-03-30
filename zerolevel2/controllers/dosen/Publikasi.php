<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//* Check if current-user is dosen *//
		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(base_url());
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['dosen']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['dosen']['userid'],
		);	
		
	}
	
	public function index() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "My Publications";
		$data['subtitle'] 	= "Daftar Publikasi";
		$data['body_page'] 	= "body/publikasi/list";

		//* Declare variables array $data to be passing to view *//
		$data['publikasi'] 	= $this->Tabel_publikasi->get(array('dosenNip'=> $this->user['id']),'tahun DESC');

		$this->load->view(THEME,$data);

	}

	public function tambah() {

		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('jurnal', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		
		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['dosenNip']	= $this->user['id'];
			$database['judul']		= $this->input->post('judul');
			$database['di'] 		= $this->input->post('jurnal');
			$database['tempat'] 	= $this->input->post('tempat');
			$database['tahun'] 		= $this->input->post('tahun');
			
			//* Add var $database to be input in the database*//
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

		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('jurnal', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		
		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['idPublikasi']= $this->input->post('id');
			$database['dosenNip']	= $this->user['id'];
			$database['judul']		= $this->input->post('judul');
			$database['di'] 		= $this->input->post('jurnal');
			$database['tempat'] 	= $this->input->post('tempat');
			$database['tahun'] 		= $this->input->post('tahun');
			$database['userUpdate']	= $this->user['nama'];
			
			//* Add var $database to be update in the database*//
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

		//* Delete entry in database *//
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

		//* Get data in tabel publikasi where $id *//
		$output = $this->Tabel_publikasi->detail(array('idPublikasi'=> $id));
		echo json_encode($output);
	}
	
}