<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_proposal'));

		if (!isset($this->session->userdata['logged_in_portal']['jurusan'])) {
			redirect(site_url('login/dosen'));
		}

		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['jurusan']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['jurusan']['userid'],
			'kode'		=> $this->session->userdata['logged_in_portal']['jurusan']['kodeUnit'],
			'unit'		=> 'jurusan',
		);
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Daftar Ajuan Seminar Proposal";
		$data['body_page'] 	= "body/akademik/proposal/approval_list";

		$data['data'] 	= $this->Tabel_proposal->get(array('lastStatus'=> 'proposal2', 'jurusanId' => $this->user['kode']),'lastDate ASC');

		foreach ($data['data'] as &$val) {
			$val['dokumen'] 		= explode(" ", $val['dokumen']);
			foreach ($val['dokumen'] as &$dok) {
				$dok = URL_DOKUMEN_MHS . $dok;
			}
			$val['kontrakSkripsi'] 	= ($val['kontrakSkripsi']) ? "Sedang dikontrak" : "Tidak Kontrak";
			$val['pelanggaranAk'] 	= ($val['pelanggaranAk']) ? "Ada" : "Tidak ada";
			$val['lastDate'] 		= date('d M Y',strtotime($val['lastDate']));

		}
		
		$this->load->view(THEME,$data);

	}

	public function approve() {
		
		$this->form_validation->set_rules('comment', 'Catatan', 'trim');
		
		if ($this->form_validation->run() == TRUE) {

			$id = $this->input->post('id');
			$idProposal = explode("-", $id);

			foreach ($idProposal as $key => $value) {
				$database[$key]['jenis'] 		= "proposal";
				$database[$key]['activityId'] 	= $value;
				$database[$key]['status'] 		= "proposal3";
				$database[$key]['comment'] 		= $this->config->item('status')['proposal3'];
				$database[$key]['userPerform']	= "Kajur";
				$database[$key]['userId']		= $this->user['id'];
				$database[$key]['userTarget'] 	= "kaprodi";
				
				$database2[$key]['idProposal']  = $value;
				$database2[$key]['lastStatus']  = "proposal3";
				$database2[$key]['lastComment'] = $this->config->item('status')['proposal3'];
				$this->Tabel_proposal->update($database2[$key]);
			}

			if ($this->Tabel_proposal->tambah_history($database)) {

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil diproses!');	

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal diproses!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('jurusan/proposal'));
	}

	public function reject() {
		$this->form_validation->set_rules('comment', 'Catatan', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$comment 	= $this->input->post('comment');
			$id 		= $this->input->post('id');
			$idProposal = explode("-", $id);

			foreach ($idProposal as $key => $value) {
				$database[$key]['jenis'] 		= "proposal";
				$database[$key]['activityId'] 	= $value;
				$database[$key]['status'] 		= "proposal0";
				$database[$key]['comment'] 		= $this->config->item('status')['proposal0'] . " - " . $comment;
				$database[$key]['userPerform']	= "Kajur";
				$database[$key]['userId']		= $this->user['id'];
				$database[$key]['userTarget'] 	= "mahasiswa";
				
				$database2[$key]['idProposal']  = $value;
				$database2[$key]['lastStatus']  = "proposal0";
				$database2[$key]['lastComment'] = $this->config->item('status')['proposal0'] . " - " . $comment;
				$this->Tabel_proposal->update($database2[$key]);
			}

			if ($this->Tabel_proposal->tambah_history($database)) {

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil diproses!');	

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal diproses!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('jurusan/proposal'));		
	}

	public function get($id) {

		$id = explode("-", $id);

		for ($i=0; $i<count($id); $i++)  {
			$data[$i] = $this->Tabel_proposal->detail(array('idProposal'=> $id[$i]));
		}
		
		echo json_encode($data);

	}	


}