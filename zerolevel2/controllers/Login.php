<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Tabel_dosen', 'Tabel_user', 'Tabel_mahasiswa', 'Portal_model', 'Tabel_pegawai'));
		$this->icon = "<p><span class=\"glyphicon glyphicon-remove\"></span>&nbsp;";
		
	}

	public function index() {

		$data['url'] = (!empty($_GET['redirect'])) ? $_GET['redirect'] : "";

		if(isset($this->session->userdata['logged_in_portal'])) {
			redirect(site_url('wall'));
		}
	
		$this->load->view("login",$data);
	
	}

	public function dosen() {

		//* Check if login is locked *//
		if ($this->session->lock_status == 'locked') {
			$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Password salah 5x! Akun terkunci 3 menit!');
		} else {
		
			//* Validate form input, CI library *//
			$this->form_validation->set_rules('namepf', 'Username', 'required');
			$this->form_validation->set_rules('passpf', 'Password', 'required');
			
			if ($this->form_validation->run() == true) {
				$username 	= $this->input->post('namepf',TRUE);
				$pwd 		= $this->input->post('passpf',TRUE);
				$url 		= ($this->input->post('url')) ? ($this->input->post('url')) : "wall";			

				//* Check username and password.*//
				//* Comment second line for testing purpose. Comment first line for live environment*//
				$result	  = $pwd == $username;
				//$result = $this->Portal_model->check_userpass_portal($username,$pwd);
				
				if ($result) {

					//* Get data dosen, from FATEK database *//
					$user_dosen = $this->Tabel_dosen->detail(array('nip' => $username));

					if ($user_dosen) {

						//* Session variable, basic info *//
						$sess_data['nama'] = $user_dosen['nama'];
						$sess_data['desc'] = $user_dosen['nip'];
						$sess_data['foto'] = (!empty($user_dosen['foto'])) ? URL_FOTO."dsn/".$user_dosen['foto'] : URL_FOTO."default.jpg";

						//* Session variable, dosen info *//
						$sess_data['dosen']['userid']    = $user_dosen['nip'];
						$sess_data['dosen']['nama']    	 = $user_dosen['nama'];
						$sess_data['dosen']['kodeProdi'] = "prodi".$user_dosen['kodeProdi'];
						$sess_data['dosen']['kodeJur']   = "jurusan".$user_dosen['kodeJurusan'];
						
						//* Cek if user is authorize user *//
						$auth_user = $this->Tabel_user->detail(array('username'=> $username));
						
						if ($auth_user) {
							$auth_user['grup'] = explode(" ", $auth_user['grup']);

							//* Register user priviledge *//
							foreach ($auth_user['grup'] as $key => $value) {

								if ($value == 'admin') {
									$sess_data['admin']['userid']	= $auth_user['username'];
									$sess_data['admin']['nama']		= $auth_user['nama'];
								}

								$sess_data['auth']['userid']	= $auth_user['username'];
								$sess_data['auth']['nama']		= $auth_user['nama'];
								$sess_data['auth']['namaUnit']	= $auth_user['namaUnit'];
								$sess_data['auth']['kodeUnit'] 	= $auth_user['kodeUnit'];
								$sess_data['auth']['grup'] 		= $value;
								$sess_data['auth']['kodeGrup']	= $auth_user['kodeGrup'];
								$sess_data['auth']['posisi']	= $auth_user['posisi'];
							}

							//* Record authorize login in database *//
							$this->Tabel_user->update(array('idUser'=> $auth_user['idUser'], 'lastLogin'=> date('Y-m-d H:i:s')));
						}

						//* Register session, clear login attempt, redirect to site *//
						$this->session->set_userdata('logged_in_portal',$sess_data);
						$this->session->unset_userdata('login_attempt');						
						redirect(site_url($url));
					
					} else {
						//* Below line is executed when user_dosen not found on FATEK database *//
						$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Tidak ada akses disini');
					}
					
				}  else {
				
					//* Below line is executed when user and pass do not match *//
					$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
					
					//* Call prosedur login protection to limit the login attempt  *//
					$this->login_protection();		
				}
			
			} else {
				$this->session->set_flashdata('message_login_dosen', validation_errors($this->icon));				
			}
		}
		if ($this->input->post('url')) redirect(site_url('login')."?redirect=".$this->input->post('url'));
		else redirect(site_url('login'));

	}

	public function mahasiswa() {

		//* Check if login is locked *//
		if ($this->session->lock_status == 'locked') {
			$this->session->set_flashdata('message_login', '<span class="glyphicon glyphicon-remove"></span> Password salah 5x! Akun terkunci 3 menit!');
		} else {
		
			//* Validate form input, CI library *//
			$this->form_validation->set_rules('namepf', 'Username', 'required');
			$this->form_validation->set_rules('passpf', 'Password', 'required');
			
			if ($this->form_validation->run() == true) {
				$username 	= $this->input->post('namepf',TRUE);
				$pwd 		= $this->input->post('passpf',TRUE);
				$url 		= ($this->input->post('url')) ? ($this->input->post('url')) : "wall";

				//* Check username and password.*//
				//* Comment second line for testing purpose. Comment first line for live environment*//
				$result = $pwd == $username;
				//$result = $this->Portal_model->check_userpass_portal($username,$pwd);

				if ($result) {
					//* Get data mahasiswa, from API server *//
					$dataAPI =  $this->apicall->get(URL_API.'mahasiswa?nim='.$username);

					//* Check if user is Fatek student *//
					if ($dataAPI->kodeFakultas == '2') {

						//$data = $this->Tabel_mahasiswa->detail(array('nim' => $dataAPI->nim;))

						//* Check if user data not it Fatek Database *//
						if (!$this->Tabel_mahasiswa->detail(array('nim' => $dataAPI->nim))) {
							
							//* Insert user data into fatek database *//
							$database['nama'] 			= $dataAPI->nama;
							$database['nim'] 			= $dataAPI->nim;
							$database['angkatan'] 		= $dataAPI->angkatan;
							$database['jurusanId'] 		= $dataAPI->kodeJurusan;
							$database['prodiId'] 		= $dataAPI->kodeProdi;
							$database['tgl_lahir'] 		= $dataAPI->tanggalLahir;
							$database['tempat_lahir']	= $dataAPI->tempatLahir;
							$database['alamat'] 		= $dataAPI->alamat;
							$database['jenis_kelamin'] 	= $dataAPI->jenisKelamin;
							$database['agama'] 			= $dataAPI->agama;
							$database['nohp'] 			= $dataAPI->noHp;
							$database['hobi'] 			= $dataAPI->hobi;

							$this->Tabel_mahasiswa->tambah($database);
						}

						//* Session variable, basic info *//
						$sess_data['nama'] = $dataAPI->nama;
						$sess_data['desc'] = $dataAPI->nim;
						$sess_data['foto'] = (!empty($dataAPI->foto)) ? $dataAPI->foto : base_url('images/user.png');

						//* Session variable, mahasiswa info *//
						$sess_data['mhs']['userid']    	= $dataAPI->nim;
						$sess_data['mhs']['nama']    	= $dataAPI->nama;
						$sess_data['mhs']['kodeProdi'] 	= "prodi".$dataAPI->kodeProdi;
						$sess_data['mhs']['kodeJur']   	= "jurusan".$dataAPI->kodeJurusan;

						//* Register session, clear login attempt, redirect to site *//
						$this->session->set_userdata('logged_in_portal',$sess_data);
						$this->session->unset_userdata('login_attempt');
						redirect(site_url('wall'));

					} else  {
						//* Below line is executed if user not Fatek student *//
						$this->session->set_flashdata('message_login_mhs', '<span class="glyphicon glyphicon-remove"></span> Tidak punya hak akses disini');
					}
					
				}  else {
					//* Below line is executed when user and pass do not match *//
					$this->session->set_flashdata('message_login_mhs', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
					
					//* Call prosedur login protection to limit the login attempt  *//
					$this->login_protection();	
				}
			} else {
				$this->session->set_flashdata('message_login_mhs', validation_errors($this->icon));				
			}
		}
		
		if ($this->input->post('url')) redirect(site_url('login')."?redirect=".$this->input->post('url'));
		else redirect(site_url('login'));

	}

	public function pegawai() {

		//* Check if login is locked *//
		if ($this->session->lock_status == 'locked') {
			$this->session->set_flashdata('message_login_peg', '<span class="glyphicon glyphicon-remove"></span> Password salah 5x! Akun terkunci 3 menit!');
		} else {
		
			//* Validate form input, CI library *//
			$this->form_validation->set_rules('namepf', 'Username', 'required');
			$this->form_validation->set_rules('passpf', 'Password', 'required');
			
			if ($this->form_validation->run() == true) {
				$username 	= $this->input->post('namepf',TRUE);
				$pwd 		= $this->input->post('passpf',TRUE);
				$url 		= ($this->input->post('url')) ? ($this->input->post('url')) : "wall";			

				//* Check username and password.*//
				//* Comment second line for testing purpose. Comment first line for live environment*//
				//$result	  = $pwd == $username;
				$result = $this->Tabel_pegawai->check_login($username,$pwd);
				
				if ($result) {

					//* Get data pegawai, from FATEK database *//
					$user_pegawai = $this->Tabel_pegawai->detail(array('nip' => $username));

					if ($user_pegawai) {

						//* Session variable, basic info *//
						$sess_data['nama'] = $user_pegawai['nama'];
						$sess_data['desc'] = $user_pegawai['nip'];
						$sess_data['foto'] = (!empty($user_pegawai['foto'])) ? URL_FOTO."pgw/".$user_pegawai['foto'] : URL_FOTO."default.jpg";

						//* Session variable, pegawai info *//
						$sess_data['pgw']['userid']    = $user_pegawai['nip'];
						$sess_data['pgw']['nama']      = $user_pegawai['nama'];
						
						//* Cek if user is authorize user *//
						$auth_user = $this->Tabel_user->detail(array('username'=> $username));
						
						if ($auth_user) {
							$auth_user['grup'] = explode(" ", $auth_user['grup']);

							//* Register user priviledge *//
							foreach ($auth_user['grup'] as $key => $value) {

								if ($value == 'admin') {
									$sess_data['admin']['userid']	= $auth_user['username'];
									$sess_data['admin']['nama']		= $auth_user['nama'];
								}

								$sess_data['auth']['userid']	= $auth_user['username'];
								$sess_data['auth']['nama']		= $auth_user['nama'];
								$sess_data['auth']['namaUnit']	= $auth_user['namaUnit'];
								$sess_data['auth']['kodeUnit'] 	= $auth_user['kodeUnit'];
								$sess_data['auth']['grup'] 		= $value;
								$sess_data['auth']['kodeGrup']	= $auth_user['kodeGrup'];
								$sess_data['auth']['posisi']	= $auth_user['posisi'];
							}

							//* Record authorize login in database *//
							$this->Tabel_user->update(array('idUser'=> $auth_user['idUser'], 'lastLogin'=> date('Y-m-d H:i:s')));
						}

						//* Register session, clear login attempt, redirect to site *//
						$this->session->set_userdata('logged_in_portal',$sess_data);
						$this->session->unset_userdata('login_attempt');						
						redirect(site_url($url));
					
					} else {
						//* Below line is executed when user_pegawai not found on FATEK database *//
						$this->session->set_flashdata('message_login_peg', '<span class="glyphicon glyphicon-remove"></span> Tidak ada akses disini');
					}
					
				}  else {
				
					//* Below line is executed when user and pass do not match *//
					$this->session->set_flashdata('message_login_peg', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
					
					//* Call prosedur login protection to limit the login attempt  *//
					$this->login_protection();		
				}
			
			} else {
				$this->session->set_flashdata('message_login_peg', validation_errors($this->icon));				
			}
		}
		if ($this->input->post('url')) redirect(site_url('login')."?redirect=".$this->input->post('url'));
		else redirect(site_url('login'));

	}	
	
	public function logout() {
		$this->session->unset_userdata('logged_in_portal');
		redirect(site_url('login'));
	}

	public function undercons() {

		$this->load->view("undercons");
	
	}

	private function login_protection() {
	//* Procedur for limiting the login attempt. CI Library  *//

		if(!$this->session->login_attempt) {
			$this->session->set_userdata('login_attempt','1');
		} else {
			$this->session->login_attempt = $this->session->login_attempt + 1;
		}
		
		if ($this->session->login_attempt == 6) {
			$this->session->set_tempdata('lock_status','locked',300);
			$this->session->unset_userdata('login_attempt');
		}
	}
	
}