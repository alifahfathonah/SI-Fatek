<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('Tabel_dokumen'));

		if (!isset($this->session->userdata['logged_in_portal']['mhs'])) {
			redirect(site_url('login/mahasiswa'));
		}
		
	}
	
	public function index() {

		$data['pageTitle'] 	= "Dokumen Mahasiswa";
		$data['body_page'] 	= "body/dokumen/list";
		$data['menu_page']  = "menu/mahasiswa";

		$mhsNim 			= $this->session->userdata['logged_in_portal']['mhs']['nim'];
		$data['dokumen'] 	= $this->Tabel_dokumen->get(array('ft_dokumen_user.userId'=> $mhsNim),'dokumenDocgroupId ASC, dokumenTahun DESC');
		
		foreach ($data['dokumen'] as &$val) {
			$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenFile'];
		}
		
		$this->load->view(THEME_MHS,$data);

	}
	
}