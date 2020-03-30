<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//* Check if current-user is mahasiswa *//
		if (!isset($this->session->userdata['logged_in_portal']['mhs'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(base_url());
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_dokumen','Tabel_docgroup'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['mhs']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['mhs']['userid'],
		);	
	}
	
	public function index() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "My Documents";
		$data['subtitle'] 	= "Daftar Dokumen";
		$data['body_page'] 	= "body/dokumen/list_without_add";
		
		//* Declare variables array $data to be passing to view *//
		$data['dokumen'] 	= $this->Tabel_dokumen->user_get(array('aso_dokumen.userId'=> $this->user['id']),'dokumenTahun DESC, dokumenDocgroupId ASC');
		$data['docgroup'] 	= $this->Tabel_docgroup->get();
		$data['ownerId']	= $this->user['id'];
		$data['loadMe']		= array(
									'tipe' => 'mhs',
									'nama' => $this->user['nama'],
									'id' => $this->user['id']
									);
		$data['fileSpec']	= "Filetype=pdf jpg jpeg; Max Size=5 Mb.";
		
		//* formatting the data to be view properly at the pageview *//
		foreach ($data['dokumen'] as &$val) {
			$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenFile'];
		}
		
		$this->load->view(THEME,$data);

	}
	
}