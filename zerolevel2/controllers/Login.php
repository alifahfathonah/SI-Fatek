<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this->load->model(array('User_model'));
		$this->icon = "<p><span class=\"glyphicon glyphicon-remove\"></span>&nbsp;";
		
	}
	
	public function index() {
		if(!isset($this->session->userdata['logged_in_admin'])) {

			if ($this->session->lock_status_adm == 'locked') {
				$this->session->set_flashdata('message_login_adm', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('username',TRUE);
					$pwd 		= $this->input->post('password',TRUE);
					
					if ($pwd == $username) {
				
						$sess_data['username'] = $username;
						$sess_data['nama'] = "Xaverius Najoan";
						$sess_data['kodeRole'] = 5;
						$sess_data['namaRole'] = "Kepala Laboratorium/Studio";
						$sess_data['kodeUnit'] = 77;
						$sess_data['namaUnit'] = "Lab. Rekayasa Perangkat Lunak";
						

						$this->session->set_userdata('logged_in_admin',$sess_data);
						$this->session->unset_userdata('login_attempt_adm');

						switch ($this->session->userdata['logged_in_admin']['kodeRole']) {
							case 1 : redirect(site_url('dekan')); break;
							case 2 : redirect(site_url('wd1')); break;
							case 3 : redirect(site_url('kajur')); break;
							case 4 : redirect(site_url('koprodi')); break;
							case 5 : redirect(site_url('kalab')); break;
							case 6 : redirect(site_url('koprodi')); break;
							default : redirect(site_url('admin')); break;
						}

						
						
						
					}  else {
					
						$this->session->set_flashdata('message_login_adm', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
						
						if(!$this->session->login_attempt_adm) {
							$this->session->set_userdata('login_attempt_adm','1');
						} else {
							$this->session->login_attempt_adm = $this->session->login_attempt_adm + 1;
						}
						
						if ($this->session->login_attempt_adm == 5) {
							$this->session->set_tempdata('lock_status_adm','locked',300);
							$this->session->unset_userdata('login_attempt_adm');
						}		
					}
				} else {
					$this->session->set_flashdata('message_login_adm', validation_errors($this->icon));				
				}
			}
			
			$this->load->view('login/admin');

		} else {
			switch ($this->session->userdata['logged_in_admin']['kodeRole']) {
				case 1 : redirect(site_url('dekan')); break;
				case 2 : redirect(site_url('wd1')); break;
				case 3 : redirect(site_url('kajur')); break;
				case 4 : redirect(site_url('koprodi')); break;
				case 5 : redirect(site_url('kalab')); break;
				case 6 : redirect(site_url('koprodi')); break;
				default : redirect(site_url('admin')); break;
			}
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in_admin');
		redirect(site_url('login'));
	}

	public function dosen() {
		if(!isset($this->session->userdata['logged_in_dosen']['nip'])) {

			if ($this->session->lock_status_dsn == 'locked') {
				$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('identity', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('identity',TRUE);
					$pwd 		= $this->input->post('password',TRUE);				

					if ($pwd == $username) {
				
						$sess_data['nip'] = $username;
						$sess_data['nama'] = "Alwin Sambul";
						$sess_data['kodeProdi'] = 77;
						$sess_data['kodeJur'] = 43;
						$sess_data['kodeFak'] = 2;

						$this->session->set_userdata('logged_in_dosen',$sess_data);
						$this->session->unset_userdata('login_attempt_dsn');
						redirect(site_url('dosen'));
						
					}  else {
					
						$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
						
						if(!$this->session->login_attempt_dsn) {
							$this->session->set_userdata('login_attempt_dsn','1');
						} else {
							$this->session->login_attempt_dsn = $this->session->login_attempt_dsn + 1;
						}
						
						if ($this->session->login_attempt == 5) {
							$this->session->set_tempdata('lock_status_dsn','locked',300);
							$this->session->unset_userdata('login_attempt_dsn');
						}		
					}
				
				} else {
					$this->session->set_flashdata('message_login_dosen', validation_errors($this->icon));				
				}
			}
			$this->load->view('login/dosen');

		} else {

			redirect(site_url('dosen'));
		}
	}
	
	public function logout_dosen() {
		$this->session->unset_userdata('logged_in_dosen');
		redirect(site_url('dosen'));
	}

public function mahasiswa() {
		if(!isset($this->session->userdata['logged_in_mahasiswa'])) {

			if ($this->session->lock_status_mhs == 'locked') {
				$this->session->set_flashdata('message_login_mhs', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('identity', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('identity',TRUE);
					$pwd 		= $this->input->post('password',TRUE);
					
					if ($pwd == $username) {
				
						$sess_data['nim'] = $username;
						$sess_data['nama'] = "Welhimson Sehang";
						$sess_data['kodeProdi'] = 77;
						$sess_data['kodeJur'] = 43;
						$sess_data['kodeFak'] = 2;

						$this->session->set_userdata('logged_in_mahasiswa',$sess_data);
						$this->session->unset_userdata('login_attempt_mhs');
						redirect(site_url('mahasiswa'));
						
					}  else {
					
						$this->session->set_flashdata('message_login_mhs', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
						
						if(!$this->session->login_attempt_mhs) {
							$this->session->set_userdata('login_attempt_mhs','1');
						} else {
							$this->session->login_attempt_mhs = $this->session->login_attempt_mhs + 1;
						}
						
						if ($this->session->login_attempt_mhs == 5) {
							$this->session->set_tempdata('lock_status_mhs','locked',300);
							$this->session->unset_userdata('login_attempt_mhs');
						}		
					}
				} else {
					$this->session->set_flashdata('message_login_mhs', validation_errors($this->icon));				
				}
			}
			
			$this->load->view('login/mahasiswa');

		} else {
			redirect(site_url('mahasiswa'));
		}
	}
	
	public function logout_mahasiswa() {
		$this->session->unset_userdata('logged_in_mahasiswa');
		redirect(site_url('mahasiswa'));
	}	
	
}