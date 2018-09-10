<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Judul extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->view = 'layout/public';
		$this->data['body_page'] = 'body_public/judul_list';
	}
	
	public function index() {
	
		$this->data['alumni'] = $this->apicall->get(URL_API."judul/fakultas?id=2");
		$this->data['pageTitle'] = "Database Judul Skripsi/TA Fakultas Teknik";

		$this->load->view($this->view,$this->data);
	
	}

	public function jurusan($jur) {

		switch ($jur) {
			case "sipil":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/jurusan?id=45");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Jurusan Teknik Sipil";
		        break;
		    case "arsitektur":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/jurusan?id=42");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Jurusan Arsitektur";
		        break;
		    case "elektro":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/jurusan?id=43");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Jurusan Teknik Elektro";
		        break;
		    case "mesin":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/jurusan?id=44");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Jurusan Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}	

		$this->load->view($this->view,$this->data);
	
	}

	public function prodi($prodi) {

		switch ($prodi) {
			case "sipil":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=14");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Teknik Sipil";
		        break;
		 	case "lingkungan":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=94");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Teknik Lingkungan";
		        break;
		    case "arsitektur":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=15");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Arsitektur";
		        break;
		    case "pwk":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=16");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Perencanaan Wilayah dan Kota";
		        break;    
		    case "elektro":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=12");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Teknik Elektro";
		        break;
		    case "informatika":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=77");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Informatika";
		        break;
		    case "mesin":
		        $this->data['judul'] = $this->apicall->get(URL_API."judul/prodi?id=13");
		        $this->data['pageTitle'] = "Database Judul Skripsi/TA Prodi Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$this->load->view($this->view,$this->data);	

	
	}
	
}