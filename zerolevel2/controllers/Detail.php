<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	
	public function __construct() {	
		parent::__construct();

		//* Check if current-user is logged user *//
		if (!isset($this->session->userdata['logged_in_portal'])) {
			redirect(site_url('login')."?redirect=".uri_string());
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_dosen','Tabel_mahasiswa', 'Tabel_pegawai', 'Tabel_kmPrestasi', 'Tabel_kmDisiplin'));
		
	}

	public function mahasiswa($nim) {
		$data['pageTitle'] 	= "Detail Mahasiswa";
		$data['body_page'] 	= "body/mahasiswa/detail";

		$data['mhsAPI'] 	= $this->apicall->get(URL_API.'mahasiswa?nim='.$nim);
		$data['mahasiswa'] 	= $this->Tabel_mahasiswa->detail(array('nim'=> $nim));
		$data['prestasi'] 	= $this->Tabel_kmPrestasi->user_get(array('userId'=> $nim), 'tglLomba DESC');
		$data['disiplin'] 	= $this->Tabel_kmDisiplin->user_get(array('userId'=> $nim), 'tglEnd DESC');

		//* formatting the data to be view properly at the pageview *//
		$data['mhsAPI']->tanggalLahir = date('d F Y', strtotime($data['mhsAPI']->tanggalLahir));

		foreach ($data['prestasi'] as &$key) {
			$key['tglLomba'] 	= date('d M Y',strtotime($key['tglLomba']));
		}

		foreach ($data['disiplin'] as &$key) {
			$key['status'] 		= ($key['tglEnd'] < date('Y-m-d')) ? TRUE : FALSE;
			$key['tglStart'] 	= date('d M Y',strtotime($key['tglStart']));
			$key['tglEnd']  	= date('d M Y',strtotime($key['tglEnd']));
		}

		//echo json_encode($data);die;
		$this->load->view(THEME,$data);
	}	

	public function dosen($nip) {

		$data['pageTitle'] 	= "Detail Dosen";
		$data['body_page'] 	= "body/dosen/detail";

		$data['dosen'] 			= $this->Tabel_dosen->detail(array('nip'=> $nip));
		$data['dosen']['foto'] 	= (!empty($data['dosen']['foto'])) ? URL_FOTO."dsn/".$data['dosen']['foto'] : URL_FOTO."default.jpg";

		$data['dosen']['tglLahir'] = date('d F Y',strtotime($data['dosen']['tglLahir']));
		$data['dosen']['jurusan'] = ucwords(strtolower($data['dosen']['jurusan']));
		$data['dosen']['prodi'] 	= ucwords(strtolower($data['dosen']['prodi']));

		if (!empty($data['dosen']['sintaId'])) $data['dosen']['sintaUrl'] = URL_SINTA.$data['dosen']['sintaId']."&view=overview";
		if (!empty($data['dosen']['googleId'])) $data['dosen']['googleUrl'] = URL_GOOGLE.$data['dosen']['googleId'];
		if (!empty($data['dosen']['scopusId'])) $data['dosen']['scopusUrl'] = URL_SCOPUS.$data['dosen']['scopusId'];

		$this->load->view(THEME,$data);
	}

	public function alumni($nim) {

		$data['pageTitle'] 	= "Detail Alumni";
		$data['body_page'] 	= "body/alumni/detail";

		$data['mhsAPI'] 	= $this->apicall->get(URL_API.'mahasiswa?nim='.$nim);
		$data['mahasiswa'] 	= $this->Tabel_mahasiswa->detail(array('nim'=> $nim));
		$data['alumniAPI'] 	= $this->apicall->get(URL_API.'alumni?nim='.$nim);
		//$data['alumniAPI'] 	= "";

		//* formatting the data to be view properly at the pageview *//
		$data['mhsAPI']->tanggalLahir = date('d F Y', strtotime($data['mhsAPI']->tanggalLahir));
		$data['alumniAPI']->tanggalLulus = date('d F Y', strtotime($data['alumniAPI']->tanggalLulus));
		$data['alumniAPI']->tanggalIjazah = date('d F Y', strtotime($data['alumniAPI']->tanggalIjazah));

		$this->load->view(THEME,$data);
	}

	public function pegawai($nip) {

		$data['pageTitle'] 	= "Detail Pegawai";
		$data['body_page'] 	= "body/pegawai/detail";

		$data['pegawai'] 			= $this->Tabel_pegawai->detail(array('nip'=> $nip));
		$data['pegawai']['foto'] 	= (!empty($data['pegawai']['foto'])) ? URL_FOTO."pgw/".$data['pegawai']['foto'] : URL_FOTO."default.jpg";

		$data['pegawai']['tglLahir'] = date('d F Y',strtotime($data['pegawai']['tglLahir']));

		$this->load->view(THEME,$data);
	}	

	public function proposal($id, $format=FALSE) {
		$data 			 = $this->Tabel_proposal->detail(array('idProposal'=> $id),'tglPengajuan ASC');
		$data['history'] = $this->Tabel_proposal->list(array('idProposal'=> $id),'tgl ASC');

		$data['kontrakSkripsi'] = ($data['kontrakSkripsi']) ? "Sedang dikontrak" : "Tidak Kontrak";
		$data['pelanggaranAk'] = ($data['pelanggaranAk']) ? "Ada" : "Tidak ada";
		$data['dokumen'] 	= explode(" ", $data['dokumen']);
		foreach ($data['dokumen'] as &$val) {
			$val = URL_DOKUMEN_MHS . $val;
		}

		foreach ($data['history'] as &$val) {
			$val['tgl'] = date('d M Y',strtotime($val['tgl']));
		}

		if ($format == 'json') {

			echo json_encode($data);
			
		} else {

			$data['pageTitle'] 	= "Detail Pengajuan Judul Skripsi";
			$data['body_page'] 	= "body/akademik/proposal/detail";

			
			$this->load->view(THEME,$data);
		}

	}				

}