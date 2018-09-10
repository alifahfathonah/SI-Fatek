<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publikasi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('login/dosen'));
		}
		$this->view = 'layout/dosen';
		
	}
	
	public function index() {

		$this->data['pageTitle'] = "Publikasi";
		$this->data['body_page'] = 'body_dosen/publikasi';

		$this->data['dosen'] = $this->Tabel_dosen->detail(array('nip'=> $this->session->userdata['logged_in_dosen']['nip']));

		$this->data['publikasi'] = $this->Tabel_publikasi->get($this->data['dosen']['dosenId']);
		$this->load->view($this->view,$this->data);

	}
	
	public function edit() {
		$id = $this->encrypt->decode($this->session->userdata['logged_in_dosen']['id_dosen']);
	
		$this->data['link_tag'] = array('bootstrap-datepicker.css');
		$this->data['subtitle'] = '[Edit]';
		$this->data['body_page'] = 'dosen/edit_detail';
		$this->data['menu'] = 'edit';

		$this->data['hyperlink_edit_personal'] 	= site_url('dosen/profile/edit-personal');
		$this->data['hyperlink_add_edu'] 		= site_url('dosen/profile/add-edu');
		$this->data['hyperlink_del_edu'] 		= site_url('dosen/profile/delete-edu').'/';
		$this->data['hyperlink_add_pub'] 		= site_url('dosen/profile/add-pub');
		$this->data['hyperlink_del_pub'] 		= site_url('dosen/profile/delete-pub').'/';	
		$this->data['hyperlink_upload_foto'] 	= site_url('dosen/profile/upload-foto');		
		
		$this->data += array('dosen' => $this->Dosen_model->detail(array('id_dosen'=> $id)),
			'pangkat' => $this->Data_model->list_all_tabel('md_pangkat'),
			'jabfung' => $this->Data_model->list_all_tabel('md_jabfung'),
			'pendidikan' => $this->Pendidikan_model->get($id),
			'publikasi' => $this->Publikasi_model->get($id),
			'jurusan' => $this->Data_model->list_all_tabel('md_jurusan'),
			'prodi' => $this->Data_model->list_all_tabel('md_prodi'),		
		);
		
		if (!$this->data['dosen']) {
			show_404();
        }
		
		$this->data['dosen']['id_dosen'] = $this->session->userdata['logged_in_dosen']['id_dosen'];
		
		foreach ($this->data['pendidikan'] as &$val) {
			$val['id_pendidikan'] = $this->encrypt->encode($val['id_pendidikan']);
		}

		foreach ($this->data['publikasi'] as &$val) {
			$val['id_publikasi'] = $this->encrypt->encode($val['id_publikasi']);
		}
		
		$this->data['dosen']['tanggal_lahir'] = ($this->data['dosen']['tanggal_lahir'] != 0 ? date('d-m-Y', strtotime($this->data['dosen']['tanggal_lahir'])) : "");

		if (empty($this->data['dosen']['foto'])) $this->data['dosen']['foto'] = "default.jpg";
		$this->data['dosen']['foto'] = base_url(DIR_FOTO_DOSEN.$this->data['dosen']['foto']);		

		$this->load->view($this->view,$this->data);
	}	

	public function edit_personal() {
			
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric|exact_length[18]');
		$this->form_validation->set_rules('nidn', 'NIDN', 'trim|numeric|exact_length[10]');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'required');
		$this->form_validation->set_rules('jabfung', 'Jabatan Fungsional', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
		$this->form_validation->set_rules('prodi', 'Program Studi', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == TRUE) {

			$database['nama'] 			= $this->input->post('nama');
			$database['alamat'] 		= $this->input->post('alamat');
			$database['tempat_lahir'] 	= $this->input->post('tempat_lahir');
			$database['tanggal_lahir'] 	= $this->input->post('tanggal_lahir');
			$database['jenis_kelamin'] 	= $this->input->post('jenis_kelamin');
			$database['nip'] 			= $this->input->post('nip');
			$database['nidn'] 			= $this->input->post('nidn');
			$database['id_pangkat'] 	= $this->input->post('pangkat');
			$database['id_jabfung'] 	= $this->input->post('jabfung');
			$database['id_jurusan'] 	= $this->input->post('jurusan');
			$database['id_prodi'] 		= $this->input->post('prodi');
			$database['status'] 		= $this->input->post('status');
			$database['email'] 			= $this->input->post('email');

			$database['id_dosen'] = $this->encrypt->decode($this->input->post('id_dosen'));
			
			if (!$database['tanggal_lahir']) {
				$database['tanggal_lahir'] = "0000-00-00";
			} else {
				$database['tanggal_lahir'] 	= date("Y-m-d", strtotime($database['tanggal_lahir']));
			}				
			$this->Dosen_model->update($database);
							
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', '<i class="fa fa-thumbs-o-up"></i>&nbsp; Berhasil di simpan!');

		} else {
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors($this->icon));
		}			
		$this->session->set_flashdata('tab','personal');
		redirect(site_url('dosen/profile/edit'));
	}
	
	public function add_edu() {
	
		$this->form_validation->set_rules('bidang', 'Bidang Ilmu', 'trim|required');
		$this->form_validation->set_rules('pt', 'Perguruan Tinggi', 'trim|required');
		$this->form_validation->set_rules('negara', 'Negara', 'trim');
		$this->form_validation->set_rules('gelar', 'Gelar', 'trim|required');
		$this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			$database['bidang_ilmu']	= $this->input->post('bidang');
			$database['nama_pt'] 		= $this->input->post('pt');
			$database['negara_pt'] 		= $this->input->post('negara');
			$database['gelar'] 			= $this->input->post('gelar');
			$database['tahun_lulus'] 	= $this->input->post('tahun_lulus');
			
			$database['id_dosen'] = $this->encrypt->decode($this->input->post('id_dosen'));
			
			$this->Pendidikan_model->tambah($database);
							
			$this->session->set_flashdata('type2', 'success');
			$this->session->set_flashdata('message2', '<i class="fa fa-thumbs-o-up"></i>&nbsp; Berhasil di simpan!');

		} else {
			$this->session->set_flashdata('type2', 'danger');
			$this->session->set_flashdata('message2', '<span class="glyphicon glyphicon-remove"></span>&nbsp; Gagal di simpan! Form tidak lengkap');
		}
		
		$this->session->set_flashdata('tab','pendidikan');
		redirect(site_url('dosen/profile/edit'));

	}
	
	public function add_pub() {
	
		$this->form_validation->set_rules('judul', 'Judul Publikasi', 'trim|required');
		$this->form_validation->set_rules('pub', 'Jurnal/Prosiding', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat', 'trim');
		$this->form_validation->set_rules('tahun', 'Tahun Publikasi', 'required');
		$this->form_validation->set_error_delimiters("<p><span class='glyphicon glyphicon-remove'></span>&nbsp;", "</p>");
		
		if ($this->form_validation->run() == TRUE) {
			$database['judul']	= $this->input->post('judul');
			$database['di'] 	= $this->input->post('pub');
			$database['tempat'] = $this->input->post('tempat');
			$database['tahun'] 	= $this->input->post('tahun');

			$database['id_dosen'] = $this->encrypt->decode($this->input->post('id_dosen'));
			
			$this->Publikasi_model->tambah($database);
			
			$this->session->set_flashdata('type3', 'success');
			$this->session->set_flashdata('message3', '<i class="fa fa-thumbs-o-up"></i>&nbsp; Berhasil di simpan!');

		} else {
			$this->session->set_flashdata('type3', 'danger');
			$this->session->set_flashdata('message3', '<span class="glyphicon glyphicon-remove"></span>&nbsp; Gagal di simpan! Form tidak lengkap');
		}
		
		$this->session->set_flashdata('tab','publikasi');
		redirect(site_url('dosen/profile/edit'));
	}
	
	public function delete_edu($id_edu) {
		
		$id_edu	= $this->encrypt->decode($id_edu);	
	
		$this->Pendidikan_model->delete($id_edu);
		$this->session->set_flashdata('type2', 'success');
		$this->session->set_flashdata('message2', '<i class="fa fa-thumbs-o-up"></i>&nbsp; Berhasil di hapus!');
		
		$this->session->set_flashdata('tab','pendidikan');
		redirect(site_url('dosen/profile/edit'));	
	}
	
	public function delete_pub($id_pub) {
		
		$id_pub	= $this->encrypt->decode($id_pub);	
		
		$this->Publikasi_model->delete($id_pub);
		$this->session->set_flashdata('type3', 'success');
		$this->session->set_flashdata('message3', '<i class="fa fa-thumbs-o-up"></i>&nbsp; Berhasil di hapus!');

		$this->session->set_flashdata('tab','publikasi');
		redirect(site_url('dosen/profile/edit'));
	}
	
	public function upload_foto() {
	
		if(!empty($_FILES['fotodosen']['name'])) {

			$this->load->library('upload', $this->config->item('pasfoto_dosen'));
			
			if(!$this->upload->do_upload('fotodosen')) {
	
				$this->session->set_flashdata('type4', 'danger');
				$this->session->set_flashdata('message4', $this->upload->display_errors($this->icon));	
				
			} else {

				$file	= $this->Data_model->get_value_tabel('ft_dosen','id_dosen',$this->encrypt->decode($this->input->post('id_dosen')),'foto');
				if (!empty($file) AND file_exists(FCPATH .DIR_FOTO_DOSEN .$file)) {
					unlink(FCPATH .DIR_FOTO_DOSEN .$file);
				}
			
				$upload_data = $this->upload->data();
				$database['foto'] = $upload_data['file_name'];
				$database['id_dosen'] = $this->encrypt->decode($this->input->post('id_dosen'));
				$this->Dosen_model->update($database);
				
				$config['source_image'] = DIR_FOTO_DOSEN .$upload_data['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 300;
				
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$this->session->set_flashdata('type4', 'success');
				$this->session->set_flashdata('message4', '<i class="fa fa-thumbs-o-up"></i>&nbsp; Berhasil di simpan!');
			}
			
		}

		$this->session->set_flashdata('tab','foto');
		redirect(site_url('dosen/profile/edit'));
	}	
	
}