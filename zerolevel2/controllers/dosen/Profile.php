<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			redirect(site_url('login/dosen'));
		}
		
	}

	public function index() {
		
		$data['pageTitle']	= "Profile Dosen";
		$data['body_page'] 	= "body/dosen/profile";
		$data['menu_page'] 	= "menu/dosen";

		$dosenNip 				= $this->session->userdata['logged_in_portal']['dosen']['nip'];
		$data['dosen'] 			= $this->Tabel_dosen->detail(array('nip'=> $dosenNip));
		$data['dosen']['foto'] 	= (!empty($data['dosen']['foto'])) ? URL_FOTO_DOSEN.$data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";
		$data['dosenSdmAPI'] 	= $this->apicall->get(URL_API.'pegawai?nip='.$dosenNip);
		$data['dosenSiaAPI'] 	= $this->apicall->get(URL_API.'dosen?nip='.$dosenNip);

		$data['dosen']['jurusan'] = ucwords(strtolower($data['dosen']['jurusan']));
		$data['dosen']['prodi'] 	= ucwords(strtolower($data['dosen']['prodi']));

		if (!empty($data['dosen']['sintaId'])) $data['dosen']['sintaUrl'] = URL_SINTA.$data['dosen']['sintaId']."&view=overview";
		if (!empty($data['dosen']['googleId'])) $data['dosen']['googleUrl'] = URL_GOOGLE.$data['dosen']['googleId'];
		if (!empty($data['dosen']['scopusId'])) $data['dosen']['scopusUrl'] = URL_SCOPUS.$data['dosen']['scopusId'];

		$this->load->view(THEME_DOSEN,$data);
	}

	public function update() {
		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'numeric');

		if ($this->form_validation->run() == TRUE) {

			$database['dosenId'] 	= $this->input->post('dosenId');
			$database['nama'] 		= $this->input->post('nama');
			$database['jabatan'] 	= $this->input->post('jabatan');
			$database['alamat'] 	= $this->input->post('alamat');
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['sintaId'] 	= $this->input->post('sintaId');
			$database['googleId'] 	= $this->input->post('googleId');
			$database['scopusId'] 	= $this->input->post('scopusId');
			$database['interest'] 	= $this->input->post('interest');
			$database['bio'] 		= $this->input->post('bio');
			$database['userUpdate']	= $this->session->userdata['logged_in_portal']['nama'];

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

		redirect(site_url('dosen/profile'));

	}

	public function change_pic() {

		$dosenNip = $this->session->userdata['logged_in_portal']['dosen']['nip'];
		
		if(!empty($_FILES['fotodosen']['name'])) {

			$this->load->library('upload', $this->config->item('pasfoto_dosen'));
			
			if (!$this->upload->do_upload('fotodosen')) {
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal disimpan! '.$this->upload->display_errors());	
				
			} else {

				$file	= $this->Tabel_dosen->detail(array('nip'=> $dosenNip))['foto'];

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
				$this->session->set_flashdata('message', 'Berhasil disimpan!');
			}
			
		}

		redirect(site_url('dosen/profile'));

	}

}