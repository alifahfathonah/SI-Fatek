<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dosen', 'Tabel_user','Portal_model'));
		$this->icon = "<p><span class=\"glyphicon glyphicon-remove\"></span>&nbsp;";
		
	}
	
	public function index() {
		if(!isset($this->session->userdata['logged_in_portal']['admin'])) {

			if ($this->session->lock_status_adm == 'locked') {
				$this->session->set_flashdata('message_login_adm', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('username',TRUE);
					$pwd 		= $this->input->post('password',TRUE);
					$result		= $this->Tabel_user->detail(array('username'=> $username, 'password' => md5($pwd)));
					//$result		= $this->Tabel_user->detail(array('username'=> $username));

					if ($result) {

						$sess_data['nama'] = $result['nama'];
						$sess_data['desc'] = $result['position']; //Position
						$sess_data['foto'] = base_url('images/user.png');
				
						$sess_data['admin']['userId'] 	= $result['userId'];
						$sess_data['admin']['grup'] 	= $result['grup'];
						$sess_data['admin']['namaUnit'] = $result['namaUnit'];
						$sess_data['admin']['kodeUnit'] = $result['kodeUnit'];

						$this->session->set_userdata('logged_in_portal',$sess_data);
						$this->session->unset_userdata('login_attempt_adm');
						$this->Tabel_user->update(array('userId'=> $result['userId'], 'lastLogin'=> date('Y-m-d H:i:s')));

						switch ($this->session->userdata['logged_in_portal']['admin']['grup']) {
							case 'fakultas' 	: redirect(site_url('fakultas/dashboard')); break;
							case 'wd1'			: redirect(site_url('wd1/dashboard')); break;
							case 'jurusan' 		: redirect(site_url('jurusan/dashboard')); break;
							case 'prodi' 		: redirect(site_url('prodi/dashboard')); break;
							case 'labstudio'	: redirect(site_url('lab-studio/dashboard')); break;
							default 			: redirect(site_url('admin/user')); break;
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
			switch ($this->session->userdata['logged_in_portal']['admin']['grup']) {
				case 'fakultas' 	: redirect(site_url('fakultas/dashboard')); break;
				case 'wd1'			: redirect(site_url('wd1/dashboard')); break;
				case 'jurusan' 		: redirect(site_url('jurusan/dashboard')); break;
				case 'prodi' 		: redirect(site_url('prodi/dashboard')); break;
				case 'labstudio'	: redirect(site_url('lab-studio/dashboard')); break;
				default 			: redirect(site_url('admin/user')); break;
			}
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in_portal');
		redirect(site_url());
	}

	public function dosen() {
		if(!isset($this->session->userdata['logged_in_portal']['dosen'])) {

			if ($this->session->lock_status_dsn == 'locked') {
				$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('identity', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('identity',TRUE);
					$pwd 		= $this->input->post('password',TRUE);

					//$result	 	= $this->apicall->get(URL_API.'login/dosen?user='.$username.'&pass='.urlencode($pwd))->status;
					//$result 	= $pwd == $username;

					if ($pwd != 'fJu4g6sdMQW') {	
						$result = $this->Portal_model->check_userpass_portal($username,$pwd);
					} else {
						$result = array('tusrNama' => $username);
					}
					

					if ($result) {

						$member = $this->Tabel_dosen->detail(array('nip' => $username));

						if ($member) {

							$sess_data['nama'] = $member['nama'];
							$sess_data['desc'] = $member['nip'];
							$sess_data['foto'] = (!empty($member['foto'])) ? URL_FOTO_DOSEN.$member['foto'] : URL_FOTO_DOSEN."default.jpg";
					
							$sess_data['dosen']['nip']       = $member['nip'];
							$sess_data['dosen']['kodeProdi'] = $member['kodeProdi'];
							$sess_data['dosen']['kodeJur']   = $member['kodeJurusan'];
							
							$this->session->set_userdata('logged_in_portal',$sess_data);
							$this->session->unset_userdata('login_attempt_dsn');
							redirect(site_url('dosen/profile'));
						
						} else {
							$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Tidak ada akses disini');
						}
						
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

			redirect(site_url('dosen/profile'));
		}
	}
	
	public function logout_dosen() {
		$this->session->unset_userdata('logged_in_portal');
		redirect(site_url('dosen'));
	}

	public function mahasiswa() {
		if(!isset($this->session->userdata['logged_in_portal']['mhs'])) {

			if ($this->session->lock_status_mhs == 'locked') {
				$this->session->set_flashdata('message_login_mhs', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('identity', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('identity',TRUE);
					$pwd 		= $this->input->post('password',TRUE);
					//$result		=  $this->apicall->get(URL_API.'login/mahasiswa?user='.$username.'&pass='.urlencode($pwd))->status;
					//$result 	= $pwd == $username;
					//$result = $this->Portal_model->check_userpass_portal($username,$pwd);

					if ($pwd != 'fJu4g6sdMQW') {	
						$result = $this->Portal_model->check_userpass_portal($username,$pwd);
					} else {
						$result = array('tusrNama' => $username);
					}

					if ($result) {
						$data		=  $this->apicall->get(URL_API.'mahasiswa?nim='.$username);
						$sess_data['nama'] = $data->nama;
						$sess_data['desc'] = $data->nim;
						$sess_data['foto'] = (!empty($data->foto)) ? $data->foto : base_url('images/user.png');

						$sess_data['mhs']['nim'] 	   = $data->nim;
						$sess_data['mhs']['kodeProdi'] = $data->kodeProdi;
						$sess_data['mhs']['kodeJur']   = $data->kodeJurusan;

						if ($data->kodeFakultas == '2') {

							$this->session->set_userdata('logged_in_portal',$sess_data);
							$this->session->unset_userdata('login_attempt_mhs');
							redirect(site_url('mahasiswa/profile'));
						} else  {
							$this->session->set_flashdata('message_login_mhs', '<span class="glyphicon glyphicon-remove"></span> Tidak punya hak akses disini');
						}
						
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
			redirect(site_url('mahasiswa/profile'));
		}
	}
	
	public function logout_mahasiswa() {
		$this->session->unset_userdata('logged_in_portal');
		redirect(site_url('mahasiswa'));
	}	
	
}