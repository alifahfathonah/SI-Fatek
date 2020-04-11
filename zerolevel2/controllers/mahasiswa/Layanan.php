<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is mahasiswa *//
		if (!isset($this->session->userdata['logged_in_portal']['mhs'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login')."?redirect=".uri_string());
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_akLayananMhs', 'Tabel_refFormReqField'));

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
		$data['pageTitle'] 	= "Permintaan Layanan Administrasi";
		$data['subtitle'] 	= "Daftar Ajuan Layanan";
		$data['body_page'] 	= "body/akademik/layanan/list_ajuan_mhs";

		//* Get data ajuan mahasiswa from database. Store at $data *//
		$data['request'] 	= $this->Tabel_akLayananMhs->get(array('nimReq'=> $this->user['id']),'tglRequest DESC');
		$data['layanan'] 	= $this->Tabel_refFormReqField->get(array('form' => 'layanan','status' => '1'),'urutan ASC');

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

			$val['authorized'] 	= ($val['prosesStatus'] != "Selesai") ? TRUE : FALSE;
		}
		
		$this->load->view(THEME,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('jenisLayanan', 'Jenis Layanan', 'required');

		if ($this->form_validation->run() == TRUE) {

			$database['nimReq'] 		= $this->user['id'];
			$database['jenisLayanan']	= $this->input->post('jenisLayanan');
			$database['infoTambahan'] 	= $this->input->post('infoTambahan');

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = "request-".$this->user['id']."-".date('Ymd');
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

			if ($this->Tabel_akLayananMhs->tambah($database, $database2)) {

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

		redirect(site_url('mahasiswa/layanan'));
	
	}

	public function delete() {

		$id = $this->input->post('id');

		//* Delete the old dokumen file*//
		$file = $this->Tabel_akLayananMhs->detail(array('idRequest' => $id));
		
		//* Check if ada file *//
		if ($file['file']) {
			$file['file'] = explode(" ", $file['file']);

			//* Delete each dokumen file*//
			foreach ($file['file'] as $key => $value) {
				if (file_exists(FCPATH.DIR_DOKUMEN_TMP.$value)) unlink(FCPATH.DIR_DOKUMEN_TMP.$value);
			}
		}

		//* Delete entry in database *//
		if ($this->Tabel_akLayananMhs->delete($id)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}	

	public function detail($id, $format=FALSE) {

		$data 			 	= $this->Tabel_akLayananMhs->detail(array('idRequest'=> $id));

		if($data['nimReq'] != $this->user['id']) {
			show_error('Access denied!');die;
		}

		if ($format == 'json') {

			echo json_encode($data);
			
		} else {


			$data['disposisi'] 	= $this->Tabel_akLayananMhs->aso_get(array('jenisId'=> $id),'prosesTgl ASC');

			if ($data['file']) {
				$data['file'] 	= explode(" ", $data['file']);
				foreach ($data['file'] as &$val) {
					$val = URL_DOKUMEN_TMP. $val;
				}
			}

			foreach ($data['disposisi'] as &$val) {
				$val['prosesTgl'] = date('d M Y g:i a',strtotime($val['prosesTgl']));

				switch ($val['prosesStatus']) {
					case "Ditolak" 	: $val['prosesColor'] = "red"; break;
					case "Selesai" 	: $val['prosesColor'] = "green"; break;
					default 		: $val['prosesColor'] = "orange";
				}
			}

			$data['pageTitle'] 	= "Detail Ajuan Layanan Administrasi";
			$data['body_page'] 	= "body/akademik/layanan/detail";

			$this->load->view(THEME,$data);
		}
	}

	public function detail_layanan($id) {

		$output 		= $this->Tabel_refFormReqField->detail(array('idReqField'=> $id));

		echo json_encode($output);

	}
}