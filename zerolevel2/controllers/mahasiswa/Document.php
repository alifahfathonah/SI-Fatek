<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	private $layout = 'layout/mahasiswa';

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dokumen','Tabel_docgroup'));

		if (!isset($this->session->userdata['logged_in_mahasiswa'])) {
			redirect(site_url('login/mahasiswa'));
		}
		
	}
	
	public function index() {
		$data['pageTitle'] = "Dokumen mahasiswa";
		$id_dosen = $this->session->userdata['logged_in_mahasiswa']['nim'];
		$data['dokumen'] = $this->Tabel_dokumen->get(array('ft_dokumen_user.userId'=> $id_dosen),'dokumenDocgroupId ASC, dokumenTahun DESC');
		$data['kategori'] = $this->Tabel_docgroup->get();
		$data['body_page'] = 'body_mahasiswa/dokumen';
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