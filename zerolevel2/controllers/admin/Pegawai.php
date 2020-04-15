<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is admin *//
		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login')."?redirect=".uri_string());
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_pegawai'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['admin']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['admin']['userid'],
		);
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Data Pegawai";
		$data['body_page'] 	= "body/admin/pegawai";
		
		$data['pegawai'] 	= $this->Tabel_pegawai->get_pegawai("*",FALSE,"nip ASC");

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['pegawai'] as &$key) {
			$key['status'] = ($key['status'])? "Aktif" : "Tidak Aktif";
		}

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['nama'] 		= $this->input->post('nama');
			$database['nip'] 		= $this->input->post('nip');
			$database['tglLahir'] 	= $this->input->post('tglLahir');
			$database['alamat'] 	= $this->input->post('alamat');
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['status']		= $this->input->post('status');
			$database['password']	= md5($this->input->post('password'));

			if ($this->input->post('password')) $database['password'] = md5($this->input->post('password'));

			if ($this->Tabel_pegawai->tambah($database)) {

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

		redirect(site_url('admin/pegawai'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idPegawai']	= $this->input->post('id');
			$database['nama'] 		= $this->input->post('nama');
			$database['nip'] 		= $this->input->post('nip');
			$database['tglLahir'] 	= $this->input->post('tglLahir');
			$database['alamat'] 	= $this->input->post('alamat');
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['status']		= $this->input->post('status');

			if ($this->input->post('password')) $database['password'] = md5($this->input->post('password'));

			if ($this->Tabel_pegawai->update($database)) {
				
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

		redirect(site_url('admin/pegawai'));
	
	}	
	
	public function delete() {

		$id_user 	= $this->input->post('id');

		if ($this->Tabel_pegawai->delete($id_user)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id, $format=FALSE) {

		if ($format == 'json') {

			$output = $this->Tabel_pegawai->detail(array('idPegawai'=> $id));
			echo json_encode($output);
			
		} else {

			$data['pageTitle']	= "Profile Pegawai";
			$data['body_page'] 	= "body/pegawai/detail";

			$data['pegawai'] 			= $this->Tabel_pegawai->detail(array('idPegawai'=> $id));
			$data['pegawai']['foto'] 	= (!empty($data['pegawai']['foto'])) ? URL_FOTO."pgw/".$data['pegawai']['foto'] : URL_FOTO."default.jpg";

			$this->load->view(THEME,$data);
		}

	}	

}