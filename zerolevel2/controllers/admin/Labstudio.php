<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labstudio extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_labstudio'));

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login/dosen'));
		}

		$this->admin = $this->session->userdata['logged_in_portal']['admin']['userid'];
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Laboratorium / Studio";
		$data['body_page'] 	= "body/admin/labstudio";
		
		$data['labstudio'] 	= $this->Tabel_labstudio->get(FALSE,'labstudioJurKode ASC');

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('nama', 'Nama Lab/Studio', 'trim|required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['labstudioNama']		= $this->input->post('nama');
			$database['labstudioJurKode']	= $this->input->post('jurusan');

			if ($this->Tabel_labstudio->tambah($database)) {

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

		redirect(site_url('admin/labstudio'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('nama', 'Nama Lab/Studio', 'trim|required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idLabstudio']		= $this->input->post('id');
			$database['labstudioNama']		= $this->input->post('nama');
			$database['labstudioJurKode']	= $this->input->post('jurusan');
			$database['userUpdate']			= $this->admin;

			if ($this->Tabel_labstudio->update($database)) {
				
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

		redirect(site_url('admin/labstudio'));
	
	}	
	
	public function delete() {

		$id_labstudio = $this->input->post('id');

		if ($this->Tabel_labstudio->delete($id_labstudio)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id) {

		$output = $this->Tabel_labstudio->detail(array('idLabstudio'=> $id));
		echo json_encode($output);

	}	

}