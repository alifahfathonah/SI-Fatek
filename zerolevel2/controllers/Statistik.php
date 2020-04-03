<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {
	
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
		$this->load->model('Tabel_dosen'); 

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'kodeunit'	=> $this->session->userdata['logged_in_portal']['auth']['kodeUnit'],
			'namaunit'	=> $this->session->userdata['logged_in_portal']['auth']['namaUnit'],
			'grup' 		=> $this->session->userdata['logged_in_portal']['auth']['grup'],
		);	
	}

	public function index() {

		switch ($this->user['grup']) {
			case "fakultas"	: $this->fakultas(); break;
			case "jurusan"	: $this->jurusan(); break;
			case "prodi"	: $this->prodi(); break;
			default 		: show_error('Access denied!');
		}

	}

	private function fakultas() {

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2')[0]->jumlah;
		$data['API']['jlhMhA'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&filter=status&by=A')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2')[0]->jumlah;
		
		//Get langsung from local database --> $data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2')[0]->jumlah;
		$data['jlhDsn'] 		= $this->Tabel_dosen->get_dosen('COUNT(*) AS jumlah','status=1')[0]['jumlah'];

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/gabung/mhs-alumni?fakultas=2');
		$data['API']['mhsjur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=jurusan&filter=status&by=A');
		$data['API']['mhspro'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=prodi&filter=status&by=A');

		$data['API']['alujur'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=jurusan');
		$data['API']['alupro'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=prodi');
		
		//Get langsung from local database --> $data['API']['dosjur'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2&groupby=jurusan');
		$data['dosjur'] 		= $this->Tabel_dosen->get_dosen('jurusan, COUNT(*) AS jumlah','status = 1','kodeJurusan');
		//Get langsung from local database --> $data['API']['dospro'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2&groupby=prodi');
		$data['dospro'] 		= $this->Tabel_dosen->get_dosen('prodi, COUNT(*) AS jumlah','status = 1','kodeProdi');


		for ($i=0; $i<count($data['API']['mhsjur']); $i++) {
			$data['API']['mhsjur'][$i]->label = $data['API']['mhsjur'][$i]->jurusan;
			$data['API']['mhsjur'][$i]->value = $data['API']['mhsjur'][$i]->jumlah;
			$data['API']['alujur'][$i]->label = $data['API']['alujur'][$i]->jurusan;
			$data['API']['alujur'][$i]->value = $data['API']['alujur'][$i]->jumlah;
			//Error --> $data['API']['dosjur'][$i]->label = $data['API']['dosjur'][$i]->jurusan;
			//Error --> $data['API']['dosjur'][$i]->value = $data['API']['dosjur'][$i]->jumlah;
			$data['dosjur'][$i]['label'] = $data['dosjur'][$i]['jurusan'];
			$data['dosjur'][$i]['value'] = $data['dosjur'][$i]['jumlah'];
		}

		$data['pageTitle'] 	= "Statistik Fakultas Teknik";
		$data['body_page'] 	= "body/dashboard/fakultas";

		//$this->output->cache(2);

		$this->load->view(THEME,$data);
		
	}

	private function jurusan() {

		$namaUnit = $this->user['namaunit'];
		$kodeUnit = $this->user['kodeunit'];

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit)[0]->jumlah;
		$data['API']['jlhMhA'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&filter=status&by=A')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/jurusan?kode='.$kodeUnit)[0]->jumlah;
		//Get langsung from local database --> $data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/dosen/jurusan?kode='.$kodeUnit)[0]->jumlah;
		$data['jlhDsn'] 		= $this->Tabel_dosen->get_dosen('COUNT(*) AS jumlah','status=1 AND kodeJurusan='.$kodeUnit,'kodeJurusan')[0]['jumlah'];

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/gabung/mhs-alumni?jurusan='.$kodeUnit);

		$data['API']['status'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=status');
		$data['API']['jalur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=jalurmasuk');
		//Error --> $data['API']['dana'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=sumberdana');
		$data['API']['gender'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=gender');
		//Error --> $data['API']['wis'] 	= $this->apicall->get(URL_API.'jumlah/alumni/jurusan?kode='.$kodeUnit.'&groupby=wisudaprd');

		for ($i=0; $i<count($data['API']['status']); $i++) {
			$data['API']['status'][$i]->label = $data['API']['status'][$i]->status;
			$data['API']['status'][$i]->value = $data['API']['status'][$i]->jumlah;
		}

		for ($i=0; $i<count($data['API']['gender']); $i++) {
			$data['API']['gender'][$i]->label = $data['API']['gender'][$i]->gender;
			$data['API']['gender'][$i]->value = $data['API']['gender'][$i]->jumlah;
		}		

		$data['pageTitle'] 	= "Statistik ".$namaUnit;
		$data['body_page'] 	= "body/dashboard/jurusan";

		$this->load->view(THEME,$data);
		
	}

	private function prodi() {

		$namaUnit = $this->user['namaunit'];
		$kodeUnit = $this->user['kodeunit'];

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit)[0]->jumlah;
		$data['API']['jlhMhA'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&filter=status&by=A')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/prodi?kode='.$kodeUnit)[0]->jumlah;
		//Get langsung from local database --> $data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/dosen/prodi?kode='.$kodeUnit)[0]->jumlah;
		$data['jlhDsn'] 		= $this->Tabel_dosen->get_dosen('COUNT(*) AS jumlah','status=1 AND kodeProdi='.$kodeUnit,'kodeProdi')[0]['jumlah'];

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/gabung/mhs-alumni?prodi='.$kodeUnit);

		$data['API']['status'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=status');
		$data['API']['jalur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=jalurmasuk');
		//Error --> $data['API']['dana'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=sumberdana');
		$data['API']['gender'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=gender');
		//Error --> $data['API']['wis'] 	= $this->apicall->get(URL_API.'jumlah/alumni/prodi?kode='.$kodeUnit.'&groupby=wisudaprd');

		for ($i=0; $i<count($data['API']['status']); $i++) {
			$data['API']['status'][$i]->label = $data['API']['status'][$i]->status;
			$data['API']['status'][$i]->value = $data['API']['status'][$i]->jumlah;
		}

		for ($i=0; $i<count($data['API']['gender']); $i++) {
			$data['API']['gender'][$i]->label = $data['API']['gender'][$i]->gender;
			$data['API']['gender'][$i]->value = $data['API']['gender'][$i]->jumlah;
		}

		$data['pageTitle'] 	= "Statistik ".$namaUnit;
		$data['body_page'] 	= "body/dashboard/prodi";

		$this->load->view(THEME,$data);
		
	}



}