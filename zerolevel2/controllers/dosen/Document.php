<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('Tabel_dokumen','Tabel_docgroup'));

		if (!isset($this->session->userdata['logged_in_portal']['dosen'])) {
			redirect(site_url('login/dosen'));
		}
		
	}
	
	public function index() {

		$data['pageTitle'] 	= "Dokumen Dosen";
		$data['body_page'] 	= "body/dokumen/list";
		$data['menu_page']  = "menu/dosen";

		$dosenNip 			= $this->session->userdata['logged_in_portal']['dosen']['nip'];
		$data['dokumen'] 	= $this->Tabel_dokumen->get(array('ft_dokumen_user.userId'=> $dosenNip),'dokumenDocgroupId ASC, dokumenTahun DESC');
		$data['kategori'] 	= $this->Tabel_docgroup->get();
		
		foreach ($data['dokumen'] as &$val) {
			$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenFile'];
		}
		
		$this->load->view(THEME_DOSEN,$data);

	}
	
}