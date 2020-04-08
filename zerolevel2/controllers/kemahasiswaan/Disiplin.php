<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disiplin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is authorized user *//
		if ($this->session->userdata['logged_in_portal']['auth']['kodeGrup'] != 'wd3') {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_kmDisiplin')); 

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['auth']['nama'],
			'userid'	=> $this->session->userdata['logged_in_portal']['auth']['userid'],
			'kodeunit'	=> $this->session->userdata['logged_in_portal']['auth']['kodeUnit'],
			'namaunit'	=> $this->session->userdata['logged_in_portal']['auth']['namaUnit'],
			'grup' 		=> $this->session->userdata['logged_in_portal']['auth']['grup'],
			'kodegrup'  => $this->session->userdata['logged_in_portal']['auth']['kodeGrup'],
		);	
	}

	public function index() {
		
		$data['pageTitle'] 	= "Daftar Disiplin Akademik";
		$data['body_page'] 	= "body/kemahasiswaan/disiplin/list_wd3";

		$data['disiplin'] 	= $this->Tabel_kmDisiplin->get(FALSE,'tglInput DESC');

		foreach ($data['disiplin'] as &$val) {

			$val['tglStart'] 	= date('d M Y',strtotime($val['tglStart']));
			$val['tglEnd'] 		= date('d M Y',strtotime($val['tglEnd']));

			$val['mahasiswa'] 	= $this->Tabel_kmDisiplin->user_get(array('jenisId' => $val['idDisiplin']));

			//because sometimes mahasiswa belum ada data didatabase fatek
			foreach ($val['mahasiswa'] as &$key) {
				$key['nama'] 	= (!empty($key['nama'])) ? $key['nama'] : $key['userId'];
				$key['nim'] 	= (!empty($key['nim'])) ? $key['nim'] : $key['userId'];
			}

		}
		
		$this->load->view(THEME,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('disiplin', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('tglStart', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tglEnd', 'Tanggal Selesai', 'required');
		$this->form_validation->set_rules('mhsdoc', 'Tag Mahasiswa', 'required');

		if ($this->form_validation->run() == TRUE) {

			$database['disiplin'] 	= $this->input->post('disiplin');
			$database['tglStart'] 	= $this->input->post('tglStart');
			$database['tglEnd'] 	= $this->input->post('tglEnd');
			$database['inputBy'] = $this->user['nama'];

			//* Declare var usertag which will be tag to this disiplin*//
			$usertag = explode(",", $this->input->post('mhsdoc'));

			if ($this->Tabel_kmDisiplin->tambah($database, $usertag)) {

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil disimpan!');	

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal disimpan!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('kemahasiswaan/disiplin'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('disiplin', 'Keterangan', 'trim|required');
		$this->form_validation->set_rules('tglStart', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tglEnd', 'Tanggal Selesai', 'required');
		$this->form_validation->set_rules('mhsdoc', 'Tag Mahasiswa', 'required');

		if ($this->form_validation->run() == TRUE) {

			$database['disiplin'] 	= $this->input->post('disiplin');
			$database['tglStart'] 	= $this->input->post('tglStart');
			$database['tglEnd'] 	= $this->input->post('tglEnd');
			$database['inputBy'] = $this->user['nama'];

			//* Declare var usertag which will be tag to this disiplin*//
			$database2['usertag'] = explode(",", $this->input->post('mhsdoc'));

			if ($this->Tabel_kmDisiplin->update($database, $database2)) {

				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil disimpan!');	

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal disimpan!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('kemahasiswaan/disiplin'));
	
	}

	public function delete() {

		$id = $this->input->post('id');

		//* Delete entry in database *//
		if ($this->Tabel_kmDisiplin->delete($id)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}	

	public function detail($id) {

		//* Declare variables array $output to be passing to output *//
		$output 		= $this->Tabel_kmDisiplin->detail(array('idDisiplin'=> $id));
		$output['user'] = $this->Tabel_kmDisiplin->user_get(array('idDisiplin'=> $id));

		//* formatting the data to be view properly at the output *//
		foreach ($output['user'] as &$key) {
			//* Get data user from API. nama, id, tipe *//
			$key['detail'] = $this->apicall->get(URL_API.'daftar/user/'.$key['userId']);
		}
		
		echo json_encode($output);

	}

}