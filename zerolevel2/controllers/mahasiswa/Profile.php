<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is mahasiswa *//
		if (!isset($this->session->userdata['logged_in_portal']['mhs'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_mahasiswa', 'Tabel_kmPrestasi', 'Tabel_kmDisiplin'));

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		$this->user = array(
			'nama' 		=> $this->session->userdata['logged_in_portal']['mhs']['nama'],
			'id'		=> $this->session->userdata['logged_in_portal']['mhs']['userid'],
		);	
		
	}

	public function index() {
		
		//* Initialize general variables for pageview properties *//
		$data['pageTitle']	= "My Profile";
		$data['body_page'] 	= "body/mahasiswa/profile";

		//* Get data from API and from local DB. Store in $data *//
		$data['mhsAPI'] 	= $this->apicall->get(URL_API.'mahasiswa?nim='.$this->user['id']);
		$data['mahasiswa'] 	= $this->Tabel_mahasiswa->detail(array('nim'=> $this->user['id']));
		$data['prestasi'] 	= $this->Tabel_kmPrestasi->user_get(array('userId'=> $this->user['id']), 'tglLomba DESC');
		$data['disiplin'] 	= $this->Tabel_kmDisiplin->user_get(array('userId'=> $this->user['id']), 'tglEnd DESC');

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['prestasi'] as &$key) {
			$key['tglLomba'] 	= date('d M Y',strtotime($key['tglLomba']));
		}

		foreach ($data['disiplin'] as &$key) {
			$key['status'] 		= ($key['tglEnd'] < date('Y-m-d')) ? TRUE : FALSE;
			$key['tglStart'] 	= date('d M Y',strtotime($key['tglStart']));
			$key['tglEnd']  	= date('d M Y',strtotime($key['tglEnd']));
		}


		$this->load->view(THEME,$data);
	}

	public function edit() {
		
		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('jalur_masuk', 'Jalur Masuk', 'trim|required');
		$this->form_validation->set_rules('beasiswa', 'Beasiswa', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('nohp', 'Nomor HP', 'trim|required');
		$this->form_validation->set_rules('sd', 'SD', 'trim|required');
		$this->form_validation->set_rules('smp', 'SMP', 'trim|required');
		$this->form_validation->set_rules('sma', 'SMA', 'trim|required');		
		
		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {		
	
			//* Declare var $database to be input at the database. Sanitize the input post *//
			$database['nim']			= $this->input->post('nim');
			$database['jalur_masuk']	= $this->input->post('jalur_masuk');
			$database['beasiswa']		= $this->input->post('beasiswa');
			$database['tempat_lahir']	= htmlspecialchars($this->input->post('tempat_lahir'));
			$database['email']			= htmlspecialchars($this->input->post('email'));
			$database['nohp']			= htmlspecialchars($this->input->post('nohp'));
			$database['status_nikah']	= $this->input->post('status_nikah');
			$database['sd']				= htmlspecialchars($this->input->post('sd'));
			$database['smp']			= htmlspecialchars($this->input->post('smp'));
			$database['sma']			= htmlspecialchars($this->input->post('sma'));

			$database['alamat']			= htmlspecialchars($this->input->post('alamat'));
			$database['alamat_ortu']	= htmlspecialchars($this->input->post('alamat_ortu'));
			$database['alamat_manado']	= htmlspecialchars($this->input->post('alamat_manado'));
			$database['status_rumah']	= $this->input->post('status_rumah');
			$database['jarak']			= htmlspecialchars(str_replace(",",".",$this->input->post('jarak')));
			$database['transportasi']	= $this->input->post('transportasi');

			$database['anak_ke']			= htmlspecialchars($this->input->post('anak_ke'));
			$database['bersaudara']			= htmlspecialchars($this->input->post('bersaudara'));
			$database['nama_ayah']			= htmlspecialchars($this->input->post('nama_ayah'));
			$database['pekerjaan_ayah']		= htmlspecialchars($this->input->post('pekerjaan_ayah'));
			$database['pendidikan_ayah']	= $this->input->post('pendidikan_ayah');
			$database['telp_ayah']			= htmlspecialchars($this->input->post('telp_ayah'));
			$database['nama_ibu']			= htmlspecialchars($this->input->post('nama_ibu'));
			$database['pekerjaan_ibu']		= htmlspecialchars($this->input->post('pekerjaan_ibu'));
			$database['pendidikan_ibu']		= $this->input->post('pendidikan_ibu');
			$database['telp_ibu']			= htmlspecialchars($this->input->post('telp_ibu'));
			$database['nama_wali']			= htmlspecialchars($this->input->post('nama_wali'));
			$database['pekerjaan_wali']		= htmlspecialchars($this->input->post('pekerjaan_wali'));
			$database['pendidikan_wali']	= $this->input->post('pendidikan_wali');
			$database['telp_wali']			= htmlspecialchars($this->input->post('telp_wali'));

			$database['facebook']		= htmlspecialchars($this->input->post('facebook'));
			$database['twitter']		= htmlspecialchars($this->input->post('twitter'));
			$database['website']		= htmlspecialchars($this->input->post('website'));
			$database['hobi']			= htmlspecialchars($this->input->post('hobi'));
			$database['cita_cita']		= htmlspecialchars($this->input->post('cita_cita'));
			$database['organisasi']		= htmlspecialchars($this->input->post('organisasi'));

			//* Add var $database to be input in the database*//
			if ($this->Tabel_mahasiswa->update($database)) {
				
				$this->session->set_flashdata('type', 'success');
				$this->session->set_flashdata('message', 'Berhasil diupdate!');

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal diupdate!');
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('mahasiswa/profile'));

	}

}