<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login'));
		}
		
	}

	public function fakultas() {

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2')[0]->jumlah;
		$data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/pegawai/academic/fakultas?kode=13')[0]->jumlah;
		$data['API']['jlhPgw'] 	= $this->apicall->get(URL_API.'jumlah/pegawai/non-academic/fakultas?kode=13')[0]->jumlah;

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/gabung/mhs-alumni?fakultas=2');
		$data['API']['mhsjur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=jurusan&filter=status&by=A');
		$data['API']['mhspro'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=prodi&filter=status&by=A');
		$data['API']['alujur'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=jurusan');
		$data['API']['alupro'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=prodi');
		$data['API']['dosjur'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2&groupby=jurusan');
		$data['API']['dospro'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2&groupby=prodi');

		for ($i=0; $i<count($data['API']['mhsjur']); $i++) {
			$data['API']['mhsjur'][$i]->label = $data['API']['mhsjur'][$i]->jurusan;
			$data['API']['mhsjur'][$i]->value = $data['API']['mhsjur'][$i]->jumlah;
			$data['API']['alujur'][$i]->label = $data['API']['alujur'][$i]->jurusan;
			$data['API']['alujur'][$i]->value = $data['API']['alujur'][$i]->jumlah;
			$data['API']['dosjur'][$i]->label = $data['API']['dosjur'][$i]->jurusan;
			$data['API']['dosjur'][$i]->value = $data['API']['dosjur'][$i]->jumlah;
		}

		$data['pageTitle'] 	= "Dashboard Fakultas Teknik";
		$data['menu_page']	= "menu/".$this->session->userdata['logged_in_portal']['admin']['grup'];
		$data['body_page'] 	= "body/dashboard/fakultas";

		$this->output->cache(30);
		$this->load->view(THEME_ADMIN,$data);
		
	}

	public function jurusan($kode = FALSE) {

		if ($kode === FALSE) {
			$namaUnit = $this->session->userdata['logged_in_portal']['admin']['namaUnit'];
			$kodeUnit = $this->session->userdata['logged_in_portal']['admin']['kodeUnit'];
		} else {
			switch($kode) {
				case '42' 	: $namaUnit = "Jurusan Arsitektur"; break;
				case '43' 	: $namaUnit = "Jurusan Teknik Elektro"; break;
				case '44' 	: $namaUnit = "Jurusan Teknik Mesin"; break;
				case '45' 	: $namaUnit = "Jurusan Teknik Sipil"; break;
				default 	: show_404();
			}
			$kodeUnit = $kode;
		}

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit)[0]->jumlah;
		$data['API']['jlhMhA'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&filter=status&by=A')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/jurusan?kode='.$kodeUnit)[0]->jumlah;
		$data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/dosen/jurusan?kode='.$kodeUnit)[0]->jumlah;

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/gabung/mhs-alumni?jurusan='.$kodeUnit);

		$data['API']['status'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=status');
		$data['API']['jalur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=jalurmasuk');
		$data['API']['dana'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=sumberdana');
		$data['API']['gender'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/jurusan?kode='.$kodeUnit.'&groupby=gender');
		$data['API']['wis'] 	= $this->apicall->get(URL_API.'jumlah/alumni/jurusan?kode='.$kodeUnit.'&groupby=wisudaprd');

		for ($i=0; $i<count($data['API']['status']); $i++) {
			$data['API']['status'][$i]->label = $data['API']['status'][$i]->status;
			$data['API']['status'][$i]->value = $data['API']['status'][$i]->jumlah;
		}

		for ($i=0; $i<count($data['API']['gender']); $i++) {
			$data['API']['gender'][$i]->label = $data['API']['gender'][$i]->gender;
			$data['API']['gender'][$i]->value = $data['API']['gender'][$i]->jumlah;
		}		

		$data['pageTitle'] 	= "Dashboard ".$namaUnit;
		$data['menu_page']	= "menu/".$this->session->userdata['logged_in_portal']['admin']['grup'];
		$data['body_page'] 	= "body/dashboard/jurusan";

		$this->load->view(THEME_ADMIN,$data);
		
	}

	public function prodi($kode = FALSE) {

		if ($kode === FALSE) {
			$namaUnit = $this->session->userdata['logged_in_portal']['admin']['namaUnit'];
			$kodeUnit = $this->session->userdata['logged_in_portal']['admin']['kodeUnit'];
		} else {
			switch($kode) {
				case '15' 	: $namaUnit = "Prodi. Arsitektur"; break;
				case '16' 	: $namaUnit = "Prodi. PWK"; break;
				case '12' 	: $namaUnit = "Prodi. Teknik Elektro"; break;
				case '77' 	: $namaUnit = "Prodi. Informatika"; break;
				case '13' 	: $namaUnit = "Prodi. Teknik Mesin"; break;
				case '14' 	: $namaUnit = "Prodi. Teknik Sipil"; break;
				case '94' 	: $namaUnit = "Prodi. Teknik Lingkungan"; break;
				default 	: show_404();
			}
			$kodeUnit = $kode;
		}

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit)[0]->jumlah;
		$data['API']['jlhMhA'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&filter=status&by=A')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/prodi?kode='.$kodeUnit)[0]->jumlah;
		$data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/dosen/prodi?kode='.$kodeUnit)[0]->jumlah;

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/gabung/mhs-alumni?prodi='.$kodeUnit);

		$data['API']['status'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=status');
		$data['API']['jalur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=jalurmasuk');
		$data['API']['dana'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=sumberdana');
		$data['API']['gender'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/prodi?kode='.$kodeUnit.'&groupby=gender');
		$data['API']['wis'] 	= $this->apicall->get(URL_API.'jumlah/alumni/prodi?kode='.$kodeUnit.'&groupby=wisudaprd');

		for ($i=0; $i<count($data['API']['status']); $i++) {
			$data['API']['status'][$i]->label = $data['API']['status'][$i]->status;
			$data['API']['status'][$i]->value = $data['API']['status'][$i]->jumlah;
		}

		for ($i=0; $i<count($data['API']['gender']); $i++) {
			$data['API']['gender'][$i]->label = $data['API']['gender'][$i]->gender;
			$data['API']['gender'][$i]->value = $data['API']['gender'][$i]->jumlah;
		}

		$data['pageTitle'] 	= "Dashboard ".$namaUnit;
		$data['menu_page']	= "menu/".$this->session->userdata['logged_in_portal']['admin']['grup'];
		$data['body_page'] 	= "body/dashboard/prodi";

		$this->load->view(THEME_ADMIN,$data);
		
	}



}