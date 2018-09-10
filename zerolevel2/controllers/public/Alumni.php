<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	private $layout = 'layout/public';

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {

		$data['alumni'] 	= $this->apicall->get(URL_API."alumni/fakultas?id=2");
		$data['body_page'] 	= 'body_public/alumni_list';
		$data['pageTitle'] 	= "Data Alumni Fakultas Teknik";

		$this->load->view($this->layout,$data);
	
	}

	public function jurusan($jur) {

		switch ($jur) {
			case "sipil":
		        $data['alumni'] 	= $this->apicall->get(URL_API."alumni/jurusan?id=45");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Teknik Sipil";
		        break;
		    case "arsitektur":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/jurusan?id=42");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Arsitektur";
		        break;
		    case "elektro":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/jurusan?id=43");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Teknik Elektro";
		        break;
		    case "mesin":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/jurusan?id=44");
		        $data['pageTitle'] 	= "Data Alumni Jurusan Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$data['body_page'] = 'body_public/alumni_list';	

		$this->load->view($this->layout,$data);
	
	}

	public function prodi($prodi) {

		switch ($prodi) {
			case "sipil":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=14");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Sipil";
		        break;
		 	case "lingkungan":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=94");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Lingkungan";
		        break;
		    case "arsitektur":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=15");
		        $data['pageTitle'] 	= "Data Alumni Prodi Arsitektur";
		        break;
		    case "pwk":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=16");
		        $data['pageTitle'] 	= "Data Alumni Prodi Perencanaan Wilayah dan Kota";
		        break;    
		    case "elektro":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=12");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Elektro";
		        break;
		    case "informatika":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=77");
		        $data['pageTitle'] 	= "Data Alumni Prodi Informatika";
		        break;
		    case "mesin":
		        $data['alumni'] 	=  $this->apicall->get(URL_API."alumni/prodi?id=13");
		        $data['pageTitle'] 	= "Data Alumni Prodi Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$data['body_page'] = 'body_public/alumni_list';	

		$this->load->view($this->layout,$data);	

	
	}

	public function nim($nim) {

		$data['alumni'] =  $this->apicall->get(URL_API."alumni?nim=".$nim);
		
		if ($data['alumni']) {

			$data['pageTitle'] = $data['alumni']->nama;
			$data['body_page'] = 'body_public/alumni_detail';	

			$this->load->view($this->layout,$data);

		} else {
			echo "Data not found";die;
		}
	
	
	}
	
}