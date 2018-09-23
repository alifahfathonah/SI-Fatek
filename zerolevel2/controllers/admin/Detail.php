<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_dosen'));

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login'));
		}

		$this->unit		= $this->session->userdata['logged_in_portal']['admin']['grup'];
		$this->namaUnit	= $this->session->userdata['logged_in_portal']['admin']['namaUnit'];
		$this->kodeUnit	= $this->session->userdata['logged_in_portal']['admin']['kodeUnit'];
		
	}

	public function mahasiswa($nim) {

		$data['pageTitle'] 	= "Detail Mahasiswa";
		$data['menu_page']	= "menu/".$this->unit;
		$data['body_page'] 	= "body/mahasiswa/detail";	

		$data['mhs'] = $this->apicall->get(URL_API.'mahasiswa?nim='.$nim);

		$this->load->view(THEME_ADMIN,$data);
	}

	public function alumni($nim) {

		$data['pageTitle'] 	= "Detail Alumni";
		$data['menu_page']	= "menu/".$this->unit;
		$data['body_page'] 	= "body/alumni/detail";	

		$data['alumni'] = $this->apicall->get(URL_API.'alumni?nim='.$nim);

		$this->load->view(THEME_ADMIN,$data);
	}

	public function dosen($nip) {

		$data['pageTitle'] 	= "Detail Dosen";
		$data['menu_page']	= "menu/".$this->unit;
		$data['body_page'] 	= "body/dosen/detail";

		$data['dosen'] 			= $this->Tabel_dosen->detail(array('nip'=> $nip));
		$data['dosen']['foto'] 	= (!empty($data['dosen']['foto'])) ? URL_FOTO_DOSEN.$data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";
		$data['dosenSdmAPI'] 		= $this->apicall->get(URL_API.'pegawai?nip='.$nip);
		$data['dosenSiaAPI'] 		= $this->apicall->get(URL_API.'dosen?nip='.$nip);

		if (!empty($data['dosen']['sintaId'])) $data['dosen']['sintaUrl'] = URL_SINTA.$data['dosen']['sintaId']."&view=overview";
		if (!empty($data['dosen']['googleId'])) $data['dosen']['googleUrl'] = URL_GOOGLE.$data['dosen']['googleId'];
		if (!empty($data['dosen']['scopusId'])) $data['dosen']['scopusUrl'] = URL_SCOPUS.$data['dosen']['scopusId'];

		$this->load->view(THEME_DOSEN,$data);
	}

	public function pegawai($nip) {

		$data['pageTitle'] 	= "Detail Pegawai";
		$data['menu_page']	= "menu/".$this->unit;
		$data['body_page'] 	= "body/pegawai/detail";

		$data['pegawai'] 	= $this->apicall->get(URL_API.'pegawai?nip='.$nip);

		$this->load->view(THEME_DOSEN,$data);
	}			

}