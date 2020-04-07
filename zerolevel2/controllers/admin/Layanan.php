<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		//* Check if current-user is admin *//
		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_refLayanan'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//

		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['admin']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['admin']['userid'],
		);
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Layanan Administrasi";
		$data['body_page'] 	= "body/admin/layanan";
		
		$data['layanan'] 	= $this->Tabel_refLayanan->get();

		foreach ($data['layanan'] as &$key) {
			$key['status'] = ($key['status']) ? "Aktif" : "Tidak Aktif";
		}

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('layanan', 'Nama Layanan', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['layanan']		= $this->input->post('layanan');
			$database['infoRequired']	= $this->input->post('infoRequired');
			$database['fileRequired']	= $this->input->post('fileRequired');
			$database['urutan']			= $this->input->post('urutan');
			$database['status']			= $this->input->post('status');

			if ($this->Tabel_refLayanan->tambah($database)) {

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

		redirect(site_url('admin/layanan'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('layanan', 'Nama Layanan', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idLayanan']		= $this->input->post('id');
			$database['layanan']		= $this->input->post('layanan');
			$database['infoRequired']	= $this->input->post('infoRequired');
			$database['fileRequired']	= $this->input->post('fileRequired');
			$database['urutan']			= $this->input->post('urutan');
			$database['status']			= $this->input->post('status');

			if ($this->Tabel_refLayanan->update($database)) {
				
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

		redirect(site_url('admin/layanan'));
	
	}	
	
	public function delete() {

		$idLayanan = $this->input->post('id');

		if ($this->Tabel_refLayanan->delete($idLayanan)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id) {

		$output = $this->Tabel_refLayanan->detail(array('idLayanan'=> $id));
		echo json_encode($output);

	}	

}