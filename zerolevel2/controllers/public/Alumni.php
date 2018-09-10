<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->view = 'layout/public';
	}
	
	public function index() {

		$this->data['alumni'] = $this->apicall->get(URL_API."alumni/fakultas?id=2");
		$this->data['body_page'] = 'body_public/alumni_list';
		$this->data['pageTitle'] = "Data Alumni Fakultas Teknik";

		$this->load->view($this->view,$this->data);
	
	}

	public function jurusan($jur) {

		switch ($jur) {
			case "sipil":
		        $this->data['alumni'] = $this->apicall->get(URL_API."alumni/jurusan?id=45");
		        $this->data['pageTitle'] = "Data Alumni Jurusan Teknik Sipil";
		        break;
		    case "arsitektur":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/jurusan?id=42");
		        $this->data['pageTitle'] = "Data Alumni Jurusan Arsitektur";
		        break;
		    case "elektro":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/jurusan?id=43");
		        $this->data['pageTitle'] = "Data Alumni Jurusan Teknik Elektro";
		        break;
		    case "mesin":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/jurusan?id=44");
		        $this->data['pageTitle'] = "Data Alumni Jurusan Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$this->data['body_page'] = 'body_public/alumni_list';	

		$this->load->view($this->view,$this->data);
	
	}

	public function prodi($prodi) {

		switch ($prodi) {
			case "sipil":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=14");
		        $this->data['pageTitle'] = "Data Alumni Prodi Teknik Sipil";
		        break;
		 	case "lingkungan":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=94");
		        $this->data['pageTitle'] = "Data Alumni Prodi Teknik Lingkungan";
		        break;
		    case "arsitektur":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=15");
		        $this->data['pageTitle'] = "Data Alumni Prodi Arsitektur";
		        break;
		    case "pwk":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=16");
		        $this->data['pageTitle'] = "Data Alumni Prodi Perencanaan Wilayah dan Kota";
		        break;    
		    case "elektro":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=12");
		        $this->data['pageTitle'] = "Data Alumni Prodi Teknik Elektro";
		        break;
		    case "informatika":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=77");
		        $this->data['pageTitle'] = "Data Alumni Prodi Informatika";
		        break;
		    case "mesin":
		        $this->data['alumni'] =  $this->apicall->get(URL_API."alumni/prodi?id=13");
		        $this->data['pageTitle'] = "Data Alumni Prodi Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$this->data['body_page'] = 'body_public/alumni_list';	

		$this->load->view($this->view,$this->data);	

	
	}

	public function nim($nim) {

		$this->data['alumni'] =  $this->apicall->get(URL_API."alumni?nim=".$nim);
		
		if ($this->data['alumni']) {

			$this->data['pageTitle'] = $this->data['alumni']->nama;
			$this->data['body_page'] = 'body_public/alumni_detail';	

			$this->load->view($this->view,$this->data);

		} else {
			echo "Data not found";die;
		}
	
	
	}
	
}