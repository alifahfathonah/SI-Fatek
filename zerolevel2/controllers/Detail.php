<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Tabel_dosen','Tabel_mahasiswa', 'Tabel_proposal'));

		if (!isset($this->session->userdata['logged_in_portal'])) {
			redirect(site_url());
		}
		
	}

	public function mahasiswa($nim) {
		$data['pageTitle'] 	= "Data Mahasiswa";
		$data['body_page'] 	= "body/mahasiswa/detail";

		$data['mhsAPI'] 	= $this->apicall->get(URL_API.'mahasiswa?nim='.$nim);
		$data['mahasiswa'] 	= $this->Tabel_mahasiswa->detail(array('nim'=> $nim));

		$this->load->view(THEME,$data);
	}	

	public function dosen($nip) {

		$data['pageTitle'] 	= "Data Dosen";
		$data['body_page'] 	= "body/dosen/detail";

		$data['dosen'] 			= $this->Tabel_dosen->detail(array('nip'=> $nip));
		$data['dosen']['foto'] 	= (!empty($data['dosen']['foto'])) ? URL_FOTO_DOSEN.$data['dosen']['foto'] : URL_FOTO_DOSEN."default.jpg";

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
		//$data['alumniAPI'] = $this->apicall->get(URL_API.'alumni?nim='.$nim);
		$data['alumniAPI'] = "";

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