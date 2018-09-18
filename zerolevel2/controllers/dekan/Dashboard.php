<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();

		if (!isset($this->session->userdata['logged_in_portal']['admin'])) {
			redirect(site_url('login'));
		}
		
	}

	public function index() {
		
		$data['pageTitle'] 	= "Dashboard";
		$data['body_page'] 	= "body/dekan/dashboard";
		$data['menu_page'] 	= "menu/dekan";

		$data['API']['jlhMhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2')[0]->jumlah;
		$data['API']['jlhAlu'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2')[0]->jumlah;
		$data['API']['jlhDsn'] 	= $this->apicall->get(URL_API.'jumlah/pegawai/academic/fakultas?kode=13')[0]->jumlah;
		$data['API']['jlhPgw'] 	= $this->apicall->get(URL_API.'jumlah/pegawai/non-academic/fakultas?kode=13')[0]->jumlah;

		$data['API']['mhs'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=angkatan');
		$data['API']['mhsjur'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=jurusan&filter=status&by=A');
		$data['API']['mhspro'] 	= $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2&groupby=prodi&filter=status&by=A');
		$data['API']['alujur'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=jurusan');
		$data['API']['alupro'] 	= $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=prodi');
		$data['API']['dosjur'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2&groupby=jurusan');
		$data['API']['dospro'] 	= $this->apicall->get(URL_API.'jumlah/dosen/fakultas?kode=2&groupby=prodi');

		for ($i=0; $i<count($data['API']['mhs']); $i++) {
			$data['API']['mhs'][$i]->mahasiswa = $data['API']['mhs'][$i]->jumlah;
			$data['API']['mhs'][$i]->alumni = $this->apicall->get(URL_API.'jumlah/alumni/fakultas?kode=2&groupby=tahun')[$i]->jumlah;
		}

		for ($i=0; $i<count($data['API']['mhsjur']); $i++) {
			$data['API']['mhsjur'][$i]->label = $data['API']['mhsjur'][$i]->jurusan;
			$data['API']['mhsjur'][$i]->value = $data['API']['mhsjur'][$i]->jumlah;
			$data['API']['alujur'][$i]->label = $data['API']['alujur'][$i]->jurusan;
			$data['API']['alujur'][$i]->value = $data['API']['alujur'][$i]->jumlah;
			$data['API']['dosjur'][$i]->label = $data['API']['dosjur'][$i]->jurusan;
			$data['API']['dosjur'][$i]->value = $data['API']['dosjur'][$i]->jumlah;
		}

		


		
		$this->load->view(THEME_ADMIN,$data);
	}

}