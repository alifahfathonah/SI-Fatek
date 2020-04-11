<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormRequired extends CI_Controller {
	
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
		$this->load->model(array('Tabel_refFormReqFIeld'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//

		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['admin']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['admin']['userid'],
		);
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Form Required Field";
		$data['body_page'] 	= "body/admin/formRequiredField";
		
		$data['formReqField'] 	= $this->Tabel_refFormReqFIeld->get(FALSE,"form ASC, urutan ASC");

		foreach ($data['formReqField'] as &$key) {
			$key['status'] = ($key['status']) ? "Aktif" : "Tidak Aktif";
			$key['infoRequired'] = nl2br($key['infoRequired']);
			$key['fileRequired'] = nl2br($key['fileRequired']);
		}

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('form', 'Nama Form', 'trim|required');
		$this->form_validation->set_rules('formField', 'Form Field', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['form']			= $this->input->post('form');
			$database['formField']		= $this->input->post('formField');
			$database['infoRequired']	= $this->input->post('infoRequired');
			$database['fileRequired']	= $this->input->post('fileRequired');
			$database['urutan']			= $this->input->post('urutan');
			$database['status']			= $this->input->post('status');

			if ($this->Tabel_refFormReqFIeld->tambah($database)) {

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

		redirect(site_url('admin/formrequired'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('form', 'Nama Form', 'trim|required');
		$this->form_validation->set_rules('formField', 'Form Field', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idReqField']		= $this->input->post('id');
			$database['form']			= $this->input->post('form');
			$database['formField']		= $this->input->post('formField');
			$database['infoRequired']	= $this->input->post('infoRequired');
			$database['fileRequired']	= $this->input->post('fileRequired');
			$database['urutan']			= $this->input->post('urutan');
			$database['status']			= $this->input->post('status');

			if ($this->Tabel_refFormReqFIeld->update($database)) {
				
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

		redirect(site_url('admin/formrequired'));
	
	}	
	
	public function delete() {

		$idReqField = $this->input->post('id');

		if ($this->Tabel_refFormReqFIeld->delete($idReqField)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id) {

		$output = $this->Tabel_refFormReqFIeld->detail(array('idReqField'=> $id));
		echo json_encode($output);

	}	

}