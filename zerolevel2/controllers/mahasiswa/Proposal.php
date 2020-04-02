<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Controller {
	
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
		$this->load->model(array('Tabel_proposal'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['mhs']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['mhs']['userid'],
		);	
		
	}

	public function index() {
		
		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Pendaftaran Seminar Proposal";
		$data['subtitle'] 	= "Daftar Ajuan Seminar Proposal";
		$data['body_page'] 	= "body/akademik/proposal/list_ajuan_mhs";

		//* Get data ajuan mahasiswa from database. Store at $data *//
		$data['data'] 	= $this->Tabel_proposal->get(array('ak_proposal.nim'=> $this->user['id']),'lastDate DESC');

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['data'] as &$val) {
			$val['lastDate'] = date('d M Y',strtotime($val['lastDate']));
		}
		
		$this->load->view(THEME,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('sksLulus', 'SKS Lulus', 'numeric|required');
		$this->form_validation->set_rules('kontrakSkripsi', 'Kontrak Skripsi', 'required');
		$this->form_validation->set_rules('pelanggaranAk', 'Pelanggaran Akademik', 'required');
		$this->form_validation->set_rules('hp', 'Nomor hp', 'numeric');

		if (empty($_FILES['dokumen']['name'][0])) {
			$this->form_validation->set_rules('dokumen', 'Dokumen Pendukung', 'required');
		}
		
		if ($this->form_validation->run() == TRUE) {

			$database['nim']			= $this->user['id'];
			$database['judul'] 			= $this->input->post('judul');
			$database['sksLulus']		= $this->input->post('sksLulus');
			$database['kontrakSkripsi'] = $this->input->post('kontrakSkripsi');
			$database['pelanggaranAk'] 	= $this->input->post('pelanggaranAk');
			$database['lastStatus'] 	= 'proposal1';
			$database['lastComment'] 	= $this->config->item('status')['proposal1'];

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = $this->user['id']."-".date('Ymd');
					$this->load->library('upload', $this->config->item('dokumen_tmp'));

					if(!$this->upload->do_upload('dokumens')) {

						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', $this->upload->display_errors());				
					
					} else {
						$filename[$i] 	= $this->upload->data()['file_name'];
					}
				}

				$database['dokumen']= implode(" ", $filename);

			}

			$database2['jenis'] 		= 'proposal';
			$database2['status'] 		= 'proposal1';
			$database2['comment'] 		= $this->config->item('status')['proposal1'];
			$database2['userPerform']	= $this->user['nama']
			$database2['userId']		= $this->user['id']
			$database2['userTarget'] 	= 'WD1';

			if ($this->Tabel_proposal->tambah($database, $database2)) {

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

		redirect(site_url('mahasiswa/proposal'));
	
	}
	
	public function delete() {

		$id 	= $this->input->post('id');

		$file 	= explode(" ", $this->Tabel_proposal->detail(array('idProposal' => $id))['dokumen']);

		foreach ($file as $key) {
			if (!empty($key)) unlink(FCPATH.DIR_DOKUMEN_MHS . $key);
		}

		$this->Tabel_proposal->delete_history($id);

		if ($this->Tabel_proposal->delete($id)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

}