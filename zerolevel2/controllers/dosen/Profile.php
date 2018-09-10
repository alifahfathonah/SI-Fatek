<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('login/dosen'));
		}
		$this->view = 'layout/dosen';
		
	}

	public function index() {
		
		$this->data['pageTitle'] = "Home";
		$this->data['body_page'] = 'body_dosen/profile_view';

		$this->data['dosen'] = $this->Tabel_dosen->detail(array('nip'=> $this->session->userdata['logged_in_dosen']['nip']));
		$this->data['dosen']['foto'] = (!empty($this->data['dosen']['foto'])) ? URL_FOTO_DOSEN.$this->data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";

		$this->data['publikasi'] = $this->Tabel_publikasi->get($this->data['dosen']['dosenId']);
		$this->data['dosenAPI'] = $this->apicall->get(URL_API.'pegawai?nip='. $this->session->userdata['logged_in_dosen']['nip']);
		//echo var_dump($this->data['dosenAPI']);die;

		if (!empty($this->data['dosen']['sintaId'])) $this->data['dosen']['sintaUrl'] = URL_SINTA.$this->data['dosen']['sintaId']."&view=overview";
		if (!empty($this->data['dosen']['googleId'])) $this->data['dosen']['googleUrl'] = URL_GOOGLE.$this->data['dosen']['googleId'];
		if (!empty($this->data['dosen']['scopusId'])) $this->data['dosen']['scopusUrl'] = URL_SCOPUS.$this->data['dosen']['scopusId'];



		$this->load->view($this->view,$this->data);

	}

	public function edit() {
		
		$this->data['pageTitle'] = "Edit Profil";
		$this->data['body_page'] = 'body_dosen/profile_edit';
		$this->data['dosen'] = $this->Tabel_dosen->detail(array('nip'=> $this->session->userdata['logged_in_dosen']['nip']));
		$this->data['dosen']['foto'] = (!empty($this->data['dosen']['foto'])) ? URL_FOTO_DOSEN.$this->data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		$this->load->view($this->view,$this->data);

	}
	
	public function simpan() {
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'numeric');

		if ($this->form_validation->run() == TRUE) {

			$database['dosenId'] 	= $this->input->post('dosenId');
			$database['nama'] 		= $this->input->post('nama');
			$database['alamat'] 	= $this->input->post('alamat');
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['sintaId'] 	= $this->input->post('sintaId');
			$database['googleId'] 	= $this->input->post('googleId');
			$database['scopusId'] 	= $this->input->post('scopusId');
			$database['interest'] 	= $this->input->post('interest');
			$database['bio'] 		= $this->input->post('bio');

			$this->Tabel_dosen->update($database);

			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil di simpan!');

		} else {
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors('Gagal di simpan! '));
		}

		redirect(site_url('dosen/profile/edit'));

	}

	public function change_pic() {
		
		if(!empty($_FILES['fotodosen']['name'])) {


			$this->load->library('upload', $this->config->item('pasfoto_dosen'));
			
			if(!$this->upload->do_upload('fotodosen')) {
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', $this->upload->display_errors());	
				
			} else {


				$file	= $this->Tabel_dosen->detail(array('nip'=> $this->session->userdata['logged_in_dosen']['nip']))['foto'];

				if (!empty($file) AND file_exists(FCPATH .DIR_FOTO_DOSEN .$file)) {
					unlink(FCPATH .DIR_FOTO_DOSEN .$file);
				}
			
				$upload_data = $this->upload->data();
				
				$database['foto'] 		= $upload_data['file_name'];
				$database['dosenId'] 	= $this->input->post('dosenId');
				
				$this->Tabel_dosen->update($database);
				
				$config['source_image'] 	= DIR_FOTO_DOSEN .$upload_data['file_name'];
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 300;
				
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil di simpan!');
			}
			
		}

		redirect(site_url('dosen/profile/edit'));

	}

}