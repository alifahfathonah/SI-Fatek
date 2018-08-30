<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_judul','Tabel_judul_apply'));

		if (!isset($this->session->userdata['logged_in_mahasiswa'])) {
			redirect(site_url('login/mahasiswa'));
		}

		$this->view 				= 'layout/mahasiswa';
		$this->data['pageTitle'] 	= "Skripsi";
		
	}

	public function index() {
		
		$this->data['judul'] = $this->Tabel_judul->get(array('judulKodeProdi'=> $this->session->userdata['logged_in_mahasiswa']['kodeProdi'],'judulStatus !='=> 'Not Available',),'judulLabstudioId ASC, judulTglUsul DESC');
		$this->data['body_page'] = 'body_mahasiswa/daftar_judul';

		$this->load->view($this->view,$this->data);

	}

	public function apply_judul() {
	
		$this->form_validation->set_rules('idJudul', 'Id judul', 'trim|required');

		if (empty($_FILES['dokumen']['name'])) {
			$this->form_validation->set_rules('dokumen', 'file proposal', 'required');
		}
		
		if ($this->form_validation->run() == TRUE) {
			$database['applyJudulId'] 	= $this->input->post('idJudul');
			$database['applyNim'] 		= $this->session->userdata['logged_in_mahasiswa']['nim'];
			$database['applyTgl'] 		= date('Y-m-d H:i:s');

			$this->config->config['proposal']['file_name'] = $database['applyNim']."-".$database['applyJudulId'];
			$this->load->library('upload', $this->config->item('proposal'));
			
			if(!empty($_FILES['dokumen']['name'])) {

				if(!$this->upload->do_upload('dokumen')) {

				
					$this->session->set_flashdata('type', 'danger');
					$this->session->set_flashdata('message', $this->upload->display_errors());				
					
				} else {
				
					$upload_data 					= $this->upload->data();
					$database['applyFileProposal'] 	= $upload_data['file_name'];
					
					if ($this->Tabel_judul_apply->tambah($database)) {
						
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', 'Berhasil apply judul!');
					
					} else {
						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', 'Database Error');
					}
				}
			}

		} else {
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', validation_errors('Gagal apply judul! '));		
		}

		redirect(site_url('mahasiswa/judul'));

	}

	public function detail_judul($id) {
		$output = $this->Tabel_judul->detail(array('judulId'=> $id));
		echo json_encode($output);

	}

	public function delete() {
		$id = $this->input->post('idJudul');
		$response = $this->Tabel_judul->delete($id);
		echo json_encode(array("status" => $id));

	}
}