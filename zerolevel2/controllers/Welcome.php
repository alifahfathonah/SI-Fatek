<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();		
	}
	
	public function index() {
	
		//$data['jlh_mahasiswa'] = 13416;
		//$data['jlh_dosen'] = 209;

		$data['jlh_mahasiswa'] = $this->apicall->get(URL_API.'jumlah/mahasiswa/fakultas?kode=2')[0]->jumlah;
		$data['jlh_dosen'] =  $this->apicall->get(URL_API.'jumlah/pegawai/academic/fakultas?kode=13')[0]->jumlah;

		$this->output->cache(30);
		$this->load->view("welcome",$data);
	
	}
	
}