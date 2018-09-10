<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_publikasi'));

		$this->view = 'layout/public';
	}
	
	public function index() {
	
		$this->data['dosen'] = $this->Tabel_dosen->get();
		$this->data['pageTitle'] = "Data Dosen Fakultas Teknik";
		$this->data['body_page'] = 'body_public/dosen_list';

		$this->load->view($this->view,$this->data);
	
	}

	public function jurusan($jur, $format = FALSE) {

		switch ($jur) {
			case "sipil":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('jurusan'=>'TEKNIK SIPIL'));
		        $this->data['pageTitle'] = "Data Dosen Jurusan Teknik Sipil";
		        break;
		    case "arsitektur":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('jurusan'=>'TEKNIK SIPIL'));
		        $this->data['pageTitle'] = "Data Dosen Jurusan Arsitektur";
		        break;
		    case "elektro":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('jurusan'=>'TEKNIK SIPIL'));
		        $this->data['pageTitle'] = "Data Dosen Jurusan Teknik Elektro";
		        break;
		    case "mesin":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('jurusan'=>'TEKNIK SIPIL'));
		        $this->data['pageTitle'] = "Data Dosen Jurusan Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$this->data['body_page'] = 'body_public/dosen_list';

		if ($format == "json") {
			header('Access-Control-Allow-Origin: *');
			header('Content-type: application/json');
			echo json_encode($this->data['dosen']);

		} else {	
			$this->load->view($this->view,$this->data);		
		}	
	}

	public function prodi($prodi, $format = FALSE) {

		switch ($prodi) {
			case "sipil":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'TEKNIK SIPIL'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Teknik Sipil";
		        break;
		 	case "lingkungan":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'TEKNIK LINGKUNGAN'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Teknik Lingkungan";
		        break;
		    case "arsitektur":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'ARSITEKTUR'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Arsitektur";
		        break;
		    case "pwk":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'PERENCANAAN WILAYAH DAN KOTA'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Perencanaan Wilayah dan Kota";
		        break;    
		    case "elektro":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'TEKNIK ELEKTRO'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Teknik Elektro";
		        break;
		    case "informatika":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'INFORMATIKA'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Informatika";
		        break;
		    case "mesin":
		        $this->data['dosen'] = $this->Tabel_dosen->get(array('prodi'=>'TEKNIK MESIN'));
		        $this->data['pageTitle'] = "Data Dosen Prodi Teknik Mesin";
		        break;
		    default:
		        echo "Data not found";die;
		}

		$this->data['body_page'] = 'body_public/dosen_list';

		if ($format == "json") {
			header('Access-Control-Allow-Origin: *');
			header('Content-type: application/json');
			echo json_encode($this->data['dosen']);

		} else {	
			$this->load->view($this->view,$this->data);		
		}	
	}

	public function id($nip, $format = FALSE) {
		
		$this->data['dosen'] = $this->Tabel_dosen->detail(array('nip'=>$nip));

		if ($this->data['dosen']) {
			$this->data['edu'] = $this->apicall->get(URL_API."dosen?nip=".$nip)->edu;
			$this->data['publikasi'] = $this->Tabel_publikasi->get($this->data['dosen']['dosenId']);

			$this->data['dosen']['foto'] = (!empty($this->data['dosen']['foto'])) ? URL_FOTO_DOSEN.$this->data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";
			if (!empty($this->data['dosen']['sintaId'])) $this->data['dosen']['sintaId'] = URL_SINTA.$this->data['dosen']['sintaId']."&view=overview";
			if (!empty($this->data['dosen']['googleId'])) $this->data['dosen']['googleId'] = URL_GOOGLE.$this->data['dosen']['googleId'];
			if (!empty($this->data['dosen']['scopusId'])) $this->data['dosen']['scopusId'] = URL_SCOPUS.$this->data['dosen']['scopusId'];

			$this->data['pageTitle'] = $this->data['dosen']['nama'];
			$this->data['body_page'] = 'body_public/dosen_detail';

			if ($format == "json") {
				header('Access-Control-Allow-Origin: *');
				header('Content-type: application/json');
				echo json_encode($this->data['dosen']);

			} else {
				$this->load->view($this->view,$this->data);		
			}

		} else {
			echo "Data not found.";die;
		}
	}

	public function publikasi($id) {
		
		$this->data['publikasi'] = $this->Tabel_publikasi->get($id);

		if ($this->data['publikasi']) {
			header('Access-Control-Allow-Origin: *');
			header('Content-type: application/json');
			echo json_encode($this->data['publikasi']);
		}	
	}
	
}