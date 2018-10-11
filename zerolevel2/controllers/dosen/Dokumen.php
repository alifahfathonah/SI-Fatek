<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('Tabel_dokumen','Tabel_docgroup'));

		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			redirect(site_url('login/dosen'));
		}

		$this->dosenNip = $this->session->userdata['logged_in_portal']['dosen']['nip'];
		
	}
	
	public function index() {

		$data['pageTitle'] 	= "Dokumen Dosen";
		$data['body_page'] 	= "body/dokumen/list_dosen";
		$data['menu_page']  = "menu/dosen";

		
		$data['dokumen'] 	= $this->Tabel_dokumen->user_get(array('ft_dokumen_user.userId'=> $this->dosenNip),'dokumenTahun DESC, dokumenDocgroupId ASC');
		$data['docgroup'] 	= $this->Tabel_docgroup->get();
		$data['ownerId']	= $this->dosenNip;
		
		foreach ($data['dokumen'] as &$val) {
			$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenDocgroupId'].'/'.$val['dokumenFile'];
		}
		
		$this->load->view(THEME_DOSEN,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('nama', 'Nama Dokumen', 'trim|required');

		if (empty($_FILES['dokumen']['name'])) {
			$this->form_validation->set_rules('dokumen', 'Upload Dokumen', 'required');
		}		

		if ($this->form_validation->run() == TRUE) {

			$database['dokumenNama']		= $this->input->post('nama');
			$database['dokumenDeskripsi']	= $this->input->post('deskripsi');
			$database['dokumenNomor'] 		= $this->input->post('nomor');
			$database['dokumenTahun']		= $this->input->post('tahun');
			$database['dokumenDocgroupId'] 	= $this->input->post('jenis');
			$database['ownerId'] 			= $this->dosenNip;
			$database['userUpdate']			= $this->session->userdata['logged_in_portal']['nama'];

			$this->config->config['dokumen']['file_name'] = $database['ownerId']."-".date('Ymd-His');
			$this->config->config['dokumen']['upload_path'] =DIR_DOKUMEN . $database['dokumenDocgroupId'] ."/";
			$this->load->library('upload', $this->config->item('dokumen'));

			if(!empty($_FILES['dokumen']['name'])) {

				if(!$this->upload->do_upload('dokumen')) {
				
					$this->session->set_flashdata('type', 'danger');
					$this->session->set_flashdata('message', $this->upload->display_errors());				
					
				} else {

					$upload_data 				= $this->upload->data();
					$database['dokumenFile'] 	= $upload_data['file_name'];
					
					$id_dokumen 	= $this->Tabel_dokumen->tambah($database);
					$multi_user[] 	= array('dokumenId' => $id_dokumen, 'userId' => $this->dosenNip);
					
					if ($this->Tabel_dokumen->link_user($multi_user)) {
					
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', 'Berhasil disimpan!');;
						
					} else {
					
						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', 'Gagal disimpan!');
					}
				}
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Gagal disimpan. Form tidak lengkap! '));
		}

		redirect(site_url('dosen/dokumen'));	

	}

	public function delete() {

		$id_dokumen = $this->input->post('id');
		
		$file = $this->Tabel_dokumen->detail(array('ft_dokumen.dokumenId' => $id_dokumen));

		if (!empty($file)) unlink(FCPATH.DIR_DOKUMEN.'/'.$file['dokumenDocgroupId'].'/'.$file['dokumenFile']);

		if ($this->Tabel_dokumen->delete($id_dokumen)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}		
	
}