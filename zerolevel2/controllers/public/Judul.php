<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul extends CI_Controller {

	private $layout = 'themes/public';

	public function __construct() {
		parent::__construct();

	}
	
	public function index() {
	
		$data['alumni'] 	= $this->apicall->get(URL_API."judul/fakultas?id=2");
		$data['pageTitle'] 	= "Database Judul Skripsi/TA Fakultas Teknik";
		$data['body_page'] 	= 'body/public/judul_list';

		$this->load->view($this->layout,$data);
	
	}

	public function jurusan($jur) {

		switch ($jur) {
			case "sipil":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/jurusan?id=45");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Jurusan Teknik Sipil";
		        break;
		    case "arsitektur":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/jurusan?id=42");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Jurusan Arsitektur";
		        break;
		    case "elektro":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/jurusan?id=43");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Jurusan Teknik Elektro";
		        break;
		    case "mesin":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/jurusan?id=44");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Jurusan Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$data['body_page'] = 'body/public/judul_list';

		$this->load->view($this->layout,$data);
	
	}

	public function prodi($prodi) {

		switch ($prodi) {
			case "sipil":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=14");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Teknik Sipil";
		        break;
		 	case "lingkungan":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=94");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Teknik Lingkungan";
		        break;
		    case "arsitektur":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=15");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Arsitektur";
		        break;
		    case "pwk":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=16");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Perencanaan Wilayah dan Kota";
		        break;    
		    case "elektro":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=12");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Teknik Elektro";
		        break;
		    case "informatika":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=77");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Informatika";
		        break;
		    case "mesin":
		        $data['judul'] 		= $this->apicall->get(URL_API."judul/prodi?id=13");
		        $data['pageTitle'] 	= "Database Judul Skripsi/TA Prodi Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$data['body_page'] = 'body/public/judul_list';

		$this->load->view($this->layout,$data);	

	
	}
	
}