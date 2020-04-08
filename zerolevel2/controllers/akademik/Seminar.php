<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class seminar extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is mahasiswa *//
		if (!isset($this->session->userdata['logged_in_portal']['auth'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login')."?redirect=".uri_string());
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_akSeminar'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['auth']['nama'],
			'userid'	=> $this->session->userdata['logged_in_portal']['auth']['userid'],
			'kodeunit'	=> $this->session->userdata['logged_in_portal']['auth']['kodeUnit'],
			'namaunit'	=> $this->session->userdata['logged_in_portal']['auth']['namaUnit'],
			'grup' 		=> $this->session->userdata['logged_in_portal']['auth']['grup'],
			'kodegrup'  => $this->session->userdata['logged_in_portal']['auth']['kodeGrup'],
		);	
	}

	public function index() {
		
		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Disposisi Pendaftaran";
		$data['subtitle'] 	= "Daftar Ajuan Pendaftaran Seminar";
		$data['body_page'] 	= "body/akademik/seminar/list_proses_ajuan";

		//* Get data ajuan mahasiswa from database. Store at $data *//
		$data['request'] 	= $this->Tabel_akSeminar->get(array('toUser'=> $this->user['kodegrup']),'tglRequest DESC');

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['request'] as &$val) {
			$val['tglRequest'] 	= date('d M Y g:i a',strtotime($val['tglRequest']));

			//if ($val['infoTambahan']) $val['infoTambahan'] = nl2br($val['infoTambahan']);

			if ($val['file']) {
				$val['file'] 	= explode(" ", $val['file']);
				foreach ($val['file'] as &$dok) {
					$dok = URL_DOKUMEN . $dok;
				}
			}
		}

		//echo json_encode($data);die;
		
		$this->load->view(THEME,$data);

	}

	public function detail($id) {

		$data 			 	= $this->Tabel_akSeminar->detail(array('idRequest'=> $id));

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

	public function detail_approval($id) {

		$id = explode("-", $id);

		for ($i=0; $i<count($id); $i++)  {
			$data[$i] = $this->Tabel_akSeminar->detail(array('idRequest'=> $id[$i]));
			$output[$i]['item1'] = $data[$i]['nama'];
			$output[$i]['item2'] = $data[$i]['nim'];
			$output[$i]['item3'] = $data[$i]['jenisSeminar'];
			$output[$i]['item4'] = $data[$i]['judul'];
		}
		
		echo json_encode($output);

	}

	public function process_request() {

		$status = $this->input->post('status');

		switch ($status) {
			case "process"	: 
								$status = "Sedang berproses"; 
								$toUser	= $this->user['kodegrup'];
								break;
			case "reject"	: 	
								$status = "Ditolak"; 
								$toUser	= "ybs";
								break;
			case "done"		: 
								$status = "Selesai"; 
								$toUser	= "ybs";
								break;
		}

		$id = $this->input->post('id');
		$idRequest = explode("-", $id);

		foreach ($idRequest as $key => $value) {

			$database[$key]['proses']		= $this->Tabel_akSeminar->detail(array('idRequest'=> $value))['proses'] + 1;
			$database[$key]['idRequest']	= $value;
			
			$database2[$key]['jenisId']			= $value;
			$database2[$key]['fromUser']		= $this->user['nama'];
			$database2[$key]['toUser']			= $toUser;
			$database2[$key]['komentar']		= $this->input->post('komentar');
			$database2[$key]['prosesId']		= $database[$key]['proses'];
			$database2[$key]['prosesStatus']	= $status;

			if ($this->Tabel_akSeminar->update_status($database[$key], $database2[$key])) {

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil diproses!');	

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal diproses!');
			}
		}

		//echo json_encode($database);echo json_encode($database2);die;

		redirect(site_url('akademik/seminar'));
	}

	public function list_all() {

		switch ($this->user['grup']) {
			case "prodi"	: $filter = array('prodiId'=> $this->user['kodeunit']); break;
			case "jurusan"	: $filter = array('jurusanId'=> $this->user['kodeunit']); break;
			default 		: $filter = FALSE;
		}
		
		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Pendaftaran Seminar";
		$data['subtitle'] 	= "Daftar Ajuan Seminar - " . $this->user['namaunit'];
		$data['body_page'] 	= "body/akademik/seminar/list_without_action";

		//* Get data ajuan mahasiswa from database. Store at $data *//
		$data['request'] 	= $this->Tabel_akSeminar->get($filter,'tglRequest DESC');

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['request'] as &$val) {
			$val['tglRequest'] 	= date('d M Y g:i a',strtotime($val['tglRequest']));

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


}