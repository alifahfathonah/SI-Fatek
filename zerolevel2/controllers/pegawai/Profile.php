<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is pegawai *//
		if (!isset($this->session->userdata['logged_in_portal']['pgw'])) {
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
			'nama' 		=> $this->session->userdata['logged_in_portal']['pgw']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['pgw']['userid'],
		);	
		
	}

	public function index() {
		
		//* Initialize general variables for pageview properties *//
		$data['pageTitle']	= "My Profile";
		$data['body_page'] 	= "body/pegawai/profile";

		//* Declare variables array $data to be passing to view *//
		$data['pegawai'] 			= $this->Tabel_pegawai->detail(array('nip'=> $this->user['id']));
		
		//* formatting the data to be view properly at the pageview *//
		$data['pegawai']['foto'] 	= (!empty($data['pegawai']['foto'])) ? URL_FOTO."pgw/".$data['pegawai']['foto'] : URL_FOTO."default.jpg";
		$data['pegawai']['tglLahir2'] = date('d F Y',strtotime($data['pegawai']['tglLahir']));

		$this->load->view(THEME,$data);
	}

	public function update() {
		
		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'required');

		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['idPegawai'] 	= $this->input->post('id');
			$database['nama'] 		= $this->input->post('nama');
			$database['tglLahir'] 	= $this->input->post('tglLahir');
			$database['alamat'] 	= $this->input->post('alamat');
			$database['email'] 		= $this->input->post('email');
			$database['hp'] 		= $this->input->post('hp');
			$database['userUpdate']	= $this->user['nama'];

			if ($this->input->post('password')) $database['password'] = md5($this->input->post('password'));

			//* Add var $database to be input in the database*//
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

		redirect(site_url('pegawai/profile'));

	}

	public function change_pic() {

		//* Check if file foto is not empty *//
		if(!empty($_FILES['fotopegawai']['name'])) {

			//* Set the configuration for upload library. Set the file name. with format idUser-currentDate.jpg *//
			$this->config->config['pasfoto_pgw']['file_name'] = $this->user['id'];
			$this->load->library('upload', $this->config->item('pasfoto_pgw'));
			
			//* Check foto has not been upload *//
			if (!$this->upload->do_upload('fotopegawai')) {
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal disimpan! '.$this->upload->display_errors());	
				
			} else {
				//* If the foto has been successfully upload *//

				//* Delete the foto old file. Check if old foto exist*//
				// $file	= $this->Tabel_dosen->detail(array('nip'=> $this->user['id']))['foto'];
				// if (!empty($file) AND file_exists(FCPATH .DIR_FOTO . "pgw/" .$file)) {
				// 	unlink(FCPATH .DIR_FOTO . "pgw/" .$file);
				// }
			
				//* Get the upload properties and store in var database *//
				$upload_data = $this->upload->data();
				$database['foto'] 		= $upload_data['file_name'];
				$database['idPegawai'] 	= $this->input->post('id');

				//* Add var $database to be update in the database*//
				$this->Tabel_pegawai->update($database);
				
				//* Load configuration for physical foto file*//
				$config['source_image'] 	= DIR_FOTO . "pgw/" .$upload_data['file_name'];
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 300;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil disimpan!');
			}
			
		}

		redirect(site_url('pegawai/profile'));

	}

}