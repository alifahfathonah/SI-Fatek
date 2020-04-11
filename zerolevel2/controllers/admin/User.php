<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
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
		$this->load->model(array('Tabel_user'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//

		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['admin']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['admin']['userid'],
		);
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Authorized User";
		$data['body_page'] 	= "body/admin/user";
		
		$data['users'] 		= $this->Tabel_user->get(array('idUser !=' => '1'), 'grup ASC, 	namaUnit ASC, posisi ASC');

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('nama', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('grup', 'Grup', 'trim');
		$this->form_validation->set_rules('kodeGrup', 'Kode Grup', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['nama']		= $this->input->post('nama');
			$database['username']	= $this->input->post('username');
			$database['posisi'] 	= $this->input->post('posisi');
			$database['namaUnit'] 	= $this->input->post('namaUnit');
			$database['kodeUnit'] 	= $this->input->post('kodeUnit');
			$database['grup'] 		= $this->input->post('grup');
			$database['kodeGrup'] 	= $this->input->post('kodeGrup');

			if ($this->Tabel_user->tambah($database)) {

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

		redirect(site_url('admin/user'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('nama', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('grup', 'Grup', 'trim');
		$this->form_validation->set_rules('kodeGrup', 'Kode Grup', 'required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idUser']		= $this->input->post('id');
			$database['nama']		= $this->input->post('nama');
			$database['username']	= $this->input->post('username');
			$database['posisi'] 	= $this->input->post('posisi');
			$database['namaUnit'] 	= $this->input->post('namaUnit');
			$database['kodeUnit'] 	= $this->input->post('kodeUnit');
			$database['grup'] 		= $this->input->post('grup');
			$database['kodeGrup'] 	= $this->input->post('kodeGrup');

			if ($this->Tabel_user->update($database)) {
				
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

		redirect(site_url('admin/user'));
	
	}	
	
	public function delete() {

		$id_user 	= $this->input->post('id');

		if ($this->Tabel_user->delete($id_user)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function detail($id) {

		$output = $this->Tabel_user->detail(array('idUser'=> $id));
		echo json_encode($output);

	}	

}