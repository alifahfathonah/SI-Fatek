<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is authorized user *//
		if (!isset($this->session->userdata['logged_in_portal']['auth'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Apicall','Tabel_dosen', 'Tabel_kmPrestasi')); 

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

	public function mahasiswa() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Data Mahasiswa ". $this->user['namaunit'];
		$data['body_page'] 	= "body/mahasiswa/list_api";

			//* Get data from API and return the data to $mhsApi *//
			$data['mhsApi'] = $this->apicall->get(URL_API.'mahasiswa/'.$this->user['grup'].'?kode='.$this->user['kodeunit'].'&filter=status&by=A');
			
			
			$this->load->view(THEME,$data);
	}

	public function alumni() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Data Alumni ". $this->user['namaunit'];
		$data['body_page'] 	= "body/alumni/list_api";

		//* Get data from API and return the data to $alumniApi *//
		$data['alumniApi'] = $this->apicall->get(URL_API.'alumni/'.$this->user['grup'].'?kode='.$this->user['kodeunit']);
		
		$this->load->view(THEME,$data);
	}

	public function dosen() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Data Dosen ". $this->user['namaunit'];
		$data['body_page'] 	= "body/dosen/list";

		//* Switch data dosen between: prodi, jurusan and fakultas *//
		switch ($this->user['grup']) {

			//* Get data dosen from local database and return to $dosen *//
			case "prodi"	: $data['dosen'] = $this->Tabel_dosen->get(array('kodeProdi' => $this->user['kodeunit'])); break;
			case "jurusan"	: $data['dosen'] = $this->Tabel_dosen->get(array('kodeJurusan' => $this->user['kodeunit'])); break;
			default 		: $data['dosen'] = $this->Tabel_dosen->get(); break;

		}

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['dosen'] as $key => $value) {
			$data['dosen'][$key]['jurusan'] = ucwords(strtolower($value['jurusan']));
			$data['dosen'][$key]['prodi'] = ucwords(strtolower($value['prodi']));
		}

		$this->load->view(THEME,$data);
	}

	public function prestasi_mahasiswa() {


		$data['pageTitle'] 	= "Data Mahasiswa Berprestasi";
		$data['body_page'] 	= "body/kemahasiswaan/prestasi/list_without_add";

		$data['prestasi'] 	= $this->Tabel_kmPrestasi->user_get(array('status'=> 'Sudah diverifikasi'),'tglLomba DESC, even ASC');

		foreach ($data['prestasi'] as &$val) {
			$val['tglLomba'] 	= date('d M Y',strtotime($val['tglLomba']));

			//because sometimes mahasiswa belum ada data didatabase fatek
			$val['nama'] 	= (!empty($val['nama'])) ? $val['nama'] : $this->apicall->get(URL_API.'daftar/user/'.$val['userId'])[0]->nama;
			$val['nim'] 	= (!empty($val['nim'])) ? $val['nim'] : $val['userId'];
		}

		//echo json_encode($data);die;
		
		$this->load->view(THEME,$data);

	}	
}