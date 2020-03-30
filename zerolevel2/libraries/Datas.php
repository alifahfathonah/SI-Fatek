<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datas {

	private $CI;

	function __construct() {
		$this->CI = get_instance();
		$this->CI->load->model(array('Apicall','Tabel_mahasiswa','Tabel_dosen')); 
	}

	//* function for get data mahasiswa from Unsrat-API database Akademika *//
	function mhsApi($var) {

		if ($var['angkatan'] === FALSE) {
			$data['mhsApi'] = $this->CI->apicall->get(URL_API.'mahasiswa/'.$var['unit'].'?kode='.$var['kode']);
			$data['subtitle']  = "";
			$data['angkatan']	= "";
		} else {
			$data['mhsApi'] 	= $this->CI->apicall->get(URL_API.'mahasiswa/'.$var['unit'].'?kode='.$var['kode'].'&filter=angkatan&by='.$var['angkatan']);
			$data['subtitle']  	= "| Angkatan ". $var['angkatan'];
			$data['angkatan']	= $var['angkatan'];
		}
		
		return $data;
	}

	//* function for get data alumni from Unsrat-API database Akademika *//
	function alumniApi($var) {

		$data['alumniApi'] = $this->CI->apicall->get(URL_API.'alumni/'.$var['unit'].'?kode='.$var['kode']);

		return $data;
	}

	//* function for get data dosen from Unsrat-API database Akademika *//
	public function dosenSia($var) {

		$data['dosenSia'] = $this->CI->apicall->get(URL_API.'dosen/'.$var['unit'].'?kode='.$var['kode']);

		return $data;
	}

	//* function for get data dosen from local database *//
	public function dosen($var) {

		switch ($var['unit']) {
			case 'fakultas'	: $data['dosen'] = $this->CI->Tabel_dosen->get(); break;
			case 'jurusan'	: $data['dosen'] = $this->CI->Tabel_dosen->get(array('kodeJurusan' => $var['kode'])); break;
			case 'prodi'	: $data['dosen'] = $this->CI->Tabel_dosen->get(array('kodeProdi' => $var['kode'])); break;
		}

		return $data;
	}

}