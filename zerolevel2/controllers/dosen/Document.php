<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	private $layout = 'layout/dosen';

	public function __construct() {

		parent::__construct();
		$this->load->model(array('Tabel_dokumen','Tabel_docgroup'));

		if (!isset($this->session->userdata['logged_in_dosen'])) {
			redirect(site_url('login/dosen'));
		}
		
	}
	
	public function index() {

		$id_dosen 			= $this->session->userdata['logged_in_dosen']['nip'];
		$data['pageTitle'] 	= "Dokumen dosen";
		$data['dokumen'] 	= $this->Tabel_dokumen->get(array('ft_dokumen_user.userId'=> $id_dosen),'dokumenDocgroupId ASC, dokumenTahun DESC');
		$data['kategori'] 	= $this->Tabel_docgroup->get();
		$data['body_page'] 	= "body_dosen/dokumen";
		
		foreach ($data['dokumen'] as &$val) {
			$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenFile'];
		}
		
		$this->load->view($this->layout,$data);

	}

	public function add() {
	
	}
	
	public function edit($id) {
	
	}
	
	public function delete($id) {
	
	}
	
}