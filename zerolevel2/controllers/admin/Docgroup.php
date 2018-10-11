<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docgroup extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_docgroup'));

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login'));
		}
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Kategori Dokumen";
		$data['body_page'] 	= "body/admin/docgroup";
		$data['menu_page'] 	= "menu/admin";
		
		$data['docgroups'] 	= $this->Tabel_docgroup->get();

		$this->load->view(THEME_ADMIN,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('nama', 'Kategori Dokumen', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['docgroupJenisDoc']	= $this->input->post('nama');

			if ($this->Tabel_docgroup->tambah($database)) {

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

		redirect(site_url('admin/docgroup'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('nama', 'Kategori Dokumen', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['docgroupId']			= $this->input->post('id');
			$database['docgroupJenisDoc']	= $this->input->post('nama');
			$database['userUpdate']			= $this->session->userdata['logged_in_portal']['nama'];

			if ($this->Tabel_docgroup->update($database)) {
				
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

		redirect(site_url('admin/docgroup'));
	
	}	
	
	public function delete() {

		$id_docgroup = $this->input->post('id');

		if ($this->Tabel_docgroup->delete($id_docgroup)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id) {

		$output = $this->Tabel_docgroup->detail(array('docgroupId'=> $id));
		echo json_encode($output);

	}	

}