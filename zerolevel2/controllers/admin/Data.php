<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login'));
		}

		$this->unit		= $this->session->userdata['logged_in_portal']['admin']['grup'];
		$this->namaUnit	= $this->session->userdata['logged_in_portal']['admin']['namaUnit'];
		$this->kodeUnit	= $this->session->userdata['logged_in_portal']['admin']['kodeUnit'];

		if ($this->unit == 'fakultas') {
			$this->namaUnit	= "Fakultas Teknik";
		}
		
	}

	public function mahasiswa($status=FALSE) {

		$data['pageTitle'] 	= "Data Mahasiswa";
		$data['menu_page']	= "menu/".$this->unit;
		$data['body_page'] 	= "body/mahasiswa/list";		

		if ($status == "all") {
			$data['mahasiswa'] = $this->apicall->get(URL_API.'mahasiswa/'.$this->unit.'?kode='.$this->kodeUnit);
			$data['subtitle']  = $this->namaUnit. " | All";
				
		} else {
			$data['mahasiswa'] = $this->apicall->get(URL_API.'mahasiswa/'.$this->unit.'?kode='.$this->kodeUnit.'&filter=status&by=A');
			$data['subtitle']  = $this->namaUnit. " | Aktif";
		}

		$this->load->view(THEME_ADMIN,$data);
	}

	public function alumni() {

		$data['pageTitle'] 	= "Data Alumni";
		$data['menu_page']	= "menu/".$this->unit;
		$data['subtitle']  	= $this->namaUnit;
		$data['body_page'] 	= "body/alumni/list";

		$data['alumni'] = $this->apicall->get(URL_API.'alumni/'.$this->unit.'?kode='.$this->kodeUnit);

		$this->load->view(THEME_ADMIN,$data);
	}

	public function dosen() {

		$data['pageTitle'] 	= "Data Dosen";
		$data['menu_page']	= "menu/".$this->unit;
		$data['subtitle']  	= $this->namaUnit;

		if ($this->unit == "fakultas") {
			$data['dosen'] = $this->apicall->get(URL_API.'pegawai/academic?kode=13');
			$data['body_page'] 	= "body/dosen/list_sdm";
		} else {
			$data['dosen'] = $this->apicall->get(URL_API.'dosen/'.$this->unit.'?kode='.$this->kodeUnit);
			$data['body_page'] 	= "body/dosen/list_sia";
		}

		$this->load->view(THEME_ADMIN,$data);
	}

	public function pegawai() {

		$data['pageTitle'] 	= "Data Pegawai";
		$data['menu_page']	= "menu/".$this->unit;
		$data['body_page'] 	= "body/pegawai/list";

		$data['pegawai'] = $this->apicall->get(URL_API.'pegawai/non-academic?kode=13');

		$this->load->view(THEME_ADMIN,$data);
	}					

}