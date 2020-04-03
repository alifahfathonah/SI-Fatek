<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	private $layout = 'themes/public';

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {

		$data['alumni'] 	= $this->apicall->get(URL_API."alumni/fakultas?kode=2");
		$data['body_page'] 	= 'body/alumni/list_public';
		$data['pageTitle'] 	= "Data Alumni Fakultas Teknik";

		foreach ($data['alumni'] as $key => $value) {
			$data['alumni'][$key]->nama = ucwords(strtolower($value->nama));
			$data['alumni'][$key]->jurusan = ucwords(strtolower($value->jurusan));
			$data['alumni'][$key]->prodi = ucwords(strtolower($value->prodi));
		}


		$this->load->view($this->layout,$data);
	}

	public function jurusan($jur) {

		switch ($jur) {
			case "sipil":
		        $data['alumni'] 	= $this->apicall->get(URL_API."alumni/jurusan?kode=45");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Teknik Sipil";
		        break;
		    case "arsitektur":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/jurusan?kode=42");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Arsitektur";
		        break;
		    case "elektro":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/jurusan?kode=43");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Teknik Elektro";
		        break;
		    case "mesin":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/jurusan?kode=44");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		foreach ($data['alumni'] as $key => $value) {
			$data['alumni'][$key]->nama = ucwords(strtolower($value->nama));
			$data['alumni'][$key]->jurusan = ucwords(strtolower($value->jurusan));
			$data['alumni'][$key]->prodi = ucwords(strtolower($value->prodi));
		}

		$data['body_page'] = 'body/alumni/list_public';	

		$this->load->view($this->layout,$data);
	
	}

	public function prodi($prodi) {

		switch ($prodi) {
			case "sipil":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=14");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Sipil";
		        break;
		 	case "lingkungan":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=94");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Lingkungan";
		        break;
		    case "arsitektur":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=15");
		        $data['pageTitle'] 	= "Data Alumni Prodi Arsitektur";
		        break;
		    case "pwk":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=16");
		        $data['pageTitle'] 	= "Data Alumni Prodi Perencanaan Wilayah dan Kota";
		        break;    
		    case "elektro":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=12");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Elektro";
		        break;
		    case "informatika":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=77");
		        $data['pageTitle'] 	= "Data Alumni Prodi Informatika";
		        break;
		    case "mesin":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?kode=13");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		foreach ($data['alumni'] as $key => $value) {
			$data['alumni'][$key]->nama = ucwords(strtolower($value->nama));
			$data['alumni'][$key]->jurusan = ucwords(strtolower($value->jurusan));
			$data['alumni'][$key]->prodi = ucwords(strtolower($value->prodi));
		}		

		$data['body_page'] = 'body/alumni/list_public';	

		$this->load->view($this->layout,$data);	

	
	}

	public function nim($nim) {

		$data['alumni'] =  $this->apicall->get(URL_API."alumni?nim=".$nim);
		
		if ($data['alumni']) {

			$data['alumni']->jurusan = ucwords(strtolower($data['alumni']->jurusan));
			$data['alumni']->prodi = ucwords(strtolower($data['alumni']->prodi));

			$data['pageTitle'] = $data['alumni']->nama;
			$data['body_page'] = 'body/alumni/detail_public';

			//* Formatting the output *//
			$data['alumni']->tanggalLulus = date('d F Y', strtotime($data['alumni']->tanggalLulus));
			$data['alumni']->tanggalIjazah = date('d F Y', strtotime($data['alumni']->tanggalIjazah));

			$this->load->view($this->layout,$data);

		} else {
			echo "Data not found";die;
		}
	
	
	}
	
}