<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is dosen *//
		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
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
		$data['pageTitle']	= "My Profile";
		$data['body_page'] 	= "body/dosen/profile";

		//* Declare variables array $data to be passing to view *//
		$data['dosen'] 			= $this->Tabel_dosen->detail(array('nip'=> $this->user['id']));
		
		//* formatting the data to be view properly at the pageview *//
		$data['dosen']['foto'] 	= (!empty($data['dosen']['foto'])) ? URL_FOTO_DOSEN.$data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";
		$data['dosen']['tglLahir2'] = date('d F Y',strtotime($data['dosen']['tglLahir']));
		$data['dosen']['jurusan'] = ucwords(strtolower($data['dosen']['jurusan']));
		$data['dosen']['prodi'] 	= ucwords(strtolower($data['dosen']['prodi']));
		if (!empty($data['dosen']['sintaId'])) $data['dosen']['sintaUrl'] = URL_SINTA.$data['dosen']['sintaId']."&view=overview";
		if (!empty($data['dosen']['googleId'])) $data['dosen']['googleUrl'] = URL_GOOGLE.$data['dosen']['googleId'];
		if (!empty($data['dosen']['scopusId'])) $data['dosen']['scopusUrl'] = URL_SCOPUS.$data['dosen']['scopusId'];

		$this->load->view(THEME,$data);
	}

	public function update() {
		
		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'numeric');

		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['idDosen'] 	= $this->input->post('id');
			$database['nama'] 		= $this->input->post('nama');
			$database['tglLahir'] 	= $this->input->post('tglLahir');
			$database['jabatan'] 	= $this->input->post('jabatan');
			$database['alamat'] 	= $this->input->post('alamat');
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['sintaId'] 	= $this->input->post('sintaId');
			$database['googleId'] 	= $this->input->post('googleId');
			$database['scopusId'] 	= $this->input->post('scopusId');
			$database['interest'] 	= $this->input->post('interest');
			$database['bio'] 		= $this->input->post('bio');
			$database['userUpdate']	= $this->user['nama'];

			//* Add var $database to be input in the database*//
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

		//* Check if file foto is not empty *//
		if(!empty($_FILES['fotodosen']['name'])) {

			//* Set the configuration for upload library. Set the file name. with format idUser-currentDate.jpg *//
			$this->config->config['pasfoto_dosen']['file_name'] = $this->user['id'];
			$this->load->library('upload', $this->config->item('pasfoto_dosen'));
			
			//* Check foto has not been upload *//
			if (!$this->upload->do_upload('fotodosen')) {
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal disimpan! '.$this->upload->display_errors());	
				
			} else {
				//* If the foto has been successfully upload *//

				//* Delete the foto old file. Check if old foto exist*//
				// $file	= $this->Tabel_dosen->detail(array('nip'=> $this->user['id']))['foto'];
				// if (!empty($file) AND file_exists(FCPATH .DIR_FOTO_DOSEN .$file)) {
				// 	unlink(FCPATH .DIR_FOTO_DOSEN .$file);
				// }
			
				//* Get the upload properties and store in var database *//
				$upload_data = $this->upload->data();
				$database['foto'] 		= $upload_data['file_name'];
				$database['idDosen'] 	= $this->user['id'];

				//* Add var $database to be update in the database*//
				$this->Tabel_dosen->update($database);
				
				//* Load configuration for physical foto file*//
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