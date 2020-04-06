<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is mahasiswa *//
		if (!isset($this->session->userdata['logged_in_portal']['mhs'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_akSeminar'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['mhs']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['mhs']['userid'],
			'prodi'		=> $this->session->userdata['logged_in_portal']['mhs']['kodeProdi'],
			'jurusan'	=> $this->session->userdata['logged_in_portal']['mhs']['kodeJur'],
		);
	}

	public function index() {
		
		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Pendaftaran Seminar";
		$data['subtitle'] 	= "Daftar Ajuan Seminar";
		$data['body_page'] 	= "body/akademik/seminar/list_ajuan_mhs";

		//* Get data ajuan mahasiswa from database. Store at $data *//
		$data['request'] 	= $this->Tabel_akSeminar->get(array('nimReq'=> $this->user['id']),'tglRequest DESC');

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['request'] as &$val) {
			$val['tglRequest'] 	= date('d M Y g:i a',strtotime($val['tglRequest']));

			if ($val['infoTambahan']) $val['infoTambahan'] = nl2br($val['infoTambahan']);

			if ($val['file']) {
				$val['file'] 	= explode(" ", $val['file']);
				foreach ($val['file'] as &$dok) {
					$dok = URL_DOKUMEN . $dok;
				}
			}

			switch ($val['prosesStatus']) {
				case "Ditolak" 	: $val['prosesColor'] = "red"; break;
				case "Selesai" 	: $val['prosesColor'] = "green"; break;
				default 		: $val['prosesColor'] = "orange";
			}
		}
		
		$this->load->view(THEME,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('jenisSeminar', 'Jenis Seminar', 'required');
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('infoTambahan', 'Informasi Tambahan', 'required');

		if (empty($_FILES['dokumen']['name'][0])) {
		 	$this->form_validation->set_rules('dokumen[]', 'Dokumen Pendukung', 'required');
		}

		if ($this->form_validation->run() == TRUE) {

			$database['nimReq'] 		= $this->user['id'];
			$database['jenisSeminar']	= $this->input->post('jenisSeminar');
			$database['judul']			= $this->input->post('judul');
			$database['infoTambahan'] 	= $this->input->post('infoTambahan');

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = "seminar-".$this->user['id']."-".date('Ymd');
					$this->load->library('upload', $this->config->item('dokumen_tmp'));

					if(!$this->upload->do_upload('dokumens')) {

						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', $this->upload->display_errors());				
					
					} else {
						$filename[$i] 	= $this->upload->data()['file_name'];
					}
				}
				$database['file']= implode(" ", $filename);
			}

			$database2['fromUser'] 		= $this->user['nama'];
			$database2['toUser'] 		= $this->user['prodi'];
			$database2['prosesId'] 		= "1";
			$database2['komentar'] 		= "Diajukan mahasiswa";
			$database2['prosesStatus'] 	= "Sedang berproses";

			if ($this->Tabel_akSeminar->tambah($database, $database2)) {

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

		redirect(site_url('mahasiswa/seminar'));
	
	}

	public function delete() {

		$id = $this->input->post('id');

		//* Delete the old dokumen file*//
		$file = $this->Tabel_akSeminar->detail(array('idRequest' => $id));
		
		//* Check if ada file *//
		if ($file['file']) {
			$file['file'] = explode(" ", $file['file']);

			//* Delete each dokumen file*//
			foreach ($file['file'] as $key => $value) {
				if (file_exists(FCPATH.DIR_DOKUMEN_TMP.$value)) unlink(FCPATH.DIR_DOKUMEN_TMP.$value);
			}
		}

		//* Delete entry in database *//
		if ($this->Tabel_akSeminar->delete($id)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}	

	public function detail($id) {

		$data 			 	= $this->Tabel_akSeminar->detail(array('idRequest'=> $id));

		if($data['nimReq'] != $this->user['id']) {
			show_error('Access denied!');die;
		}

		$data['disposisi'] 	= $this->Tabel_akSeminar->aso_get(array('jenisId'=> $id),'prosesTgl ASC');

		if ($data['file']) {
			$data['file'] 	= explode(" ", $data['file']);
			foreach ($data['file'] as &$val) {
				$val = URL_DOKUMEN_TMP. $val;
			}
		}

		foreach ($data['disposisi'] as &$val) {
			$val['prosesTgl'] = date('d M Y g:i a',strtotime($val['prosesTgl']));
		}

		$data['pageTitle'] 	= "Detail Ajuan Pendaftaran Seminar";
		$data['body_page'] 	= "body/akademik/seminar/detail";

		$this->load->view(THEME,$data);


	}	

}