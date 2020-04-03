<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
	
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
		$this->load->model(array('Tabel_dosen'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['admin']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['admin']['userid'],
		);
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Kelola Data Dosen";
		$data['body_page'] 	= "body/admin/dosen";
		
		$data['dosen'] 		= $this->Tabel_dosen->get_dosen();

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'numeric|required');
		$this->form_validation->set_rules('nidn', 'NIDN', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'numeric');
		
		if ($this->form_validation->run() == TRUE) {

			$database['nama']		= $this->input->post('nama');
			$database['nip']		= $this->input->post('nip');
			$database['nidn'] 		= $this->input->post('nidn');
			$database['kodePegawai']= $this->input->post('kodePegawai');
			$database['jabatan'] 	= $this->input->post('jabatan');
			$database['alamat']		= $this->input->post('alamat');
			$database['kodeJurusan']= explode('|',$this->input->post('jurusan'))[0];
			$database['jurusan']	= explode('|',$this->input->post('jurusan'))[1];
			$database['kodeProdi'] 	= explode('|',$this->input->post('prodi'))[0];
			$database['prodi'] 		= explode('|',$this->input->post('prodi'))[1];
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['sintaId']	= $this->input->post('sintaId');
			$database['googleId']	= $this->input->post('googleId');
			$database['scopusId'] 	= $this->input->post('scopusId');
			$database['interest'] 	= $this->input->post('interest');
			$database['bio'] 		= $this->input->post('bio');
			$database['status']		= $this->input->post('status');

			if ($this->Tabel_dosen->tambah($database)) {

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

		redirect(site_url('admin/dosen'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'numeric|required');
		$this->form_validation->set_rules('nidn', 'NIDN', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'numeric');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idDosen']	= $this->input->post('id');
			$database['nama']		= $this->input->post('nama');
			$database['nip']		= $this->input->post('nip');
			$database['nidn'] 		= $this->input->post('nidn');
			$database['kodePegawai']= $this->input->post('kodePegawai');
			$database['jabatan'] 	= $this->input->post('jabatan');
			$database['alamat']		= $this->input->post('alamat');
			$database['kodeJurusan']= explode('|',$this->input->post('jurusan'))[0];
			$database['jurusan']	= explode('|',$this->input->post('jurusan'))[1];
			$database['kodeProdi'] 	= explode('|',$this->input->post('prodi'))[0];
			$database['prodi'] 		= explode('|',$this->input->post('prodi'))[1];
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['sintaId']	= $this->input->post('sintaId');
			$database['googleId']	= $this->input->post('googleId');
			$database['scopusId'] 	= $this->input->post('scopusId');
			$database['interest'] 	= $this->input->post('interest');
			$database['bio'] 		= $this->input->post('bio');
			$database['userUpdate']	= $this->user['nama'];
			$database['status']		= $this->input->post('status');

			if ($this->Tabel_dosen->update($database)) {
				
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

		redirect(site_url('admin/dosen'));
	
	}	
	
	public function delete() {

		$id_user 	= $this->input->post('id');

		if ($this->Tabel_dosen->delete($id_user)) {
				
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

			$output = $this->Tabel_dosen->detail(array('idDosen'=> $id));
			echo json_encode($output);
			
		} else {

			$data['pageTitle']	= "Profile Dosen";
			$data['body_page'] 	= "body/dosen/detail";

			$data['dosen'] 			= $this->Tabel_dosen->detail(array('idDosen'=> $id));
			$data['dosen']['foto'] 	= (!empty($data['dosen']['foto'])) ? URL_FOTO_DOSEN.$data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";
			//$data['dosenSdmAPI'] 		= $this->apicall->get(URL_API.'pegawai?nip='.$dosenNip);
			//$data['dosenSiaAPI'] 		= $this->apicall->get(URL_API.'dosen?nip='.$dosenNip);

			if (!empty($data['dosen']['sintaId'])) $data['dosen']['sintaUrl'] = URL_SINTA.$data['dosen']['sintaId']."&view=overview";
			if (!empty($data['dosen']['googleId'])) $data['dosen']['googleUrl'] = URL_GOOGLE.$data['dosen']['googleId'];
			if (!empty($data['dosen']['scopusId'])) $data['dosen']['scopusUrl'] = URL_SCOPUS.$data['dosen']['scopusId'];

			$this->load->view(THEME,$data);
		}

	}	

}