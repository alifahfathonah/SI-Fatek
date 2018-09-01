<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xave extends CI_Controller {

	public function index()
	{
		$this->data['jlh_mahasiswa'] = 7000;
		$this->data['jlh_dosen'] = 800;
	
		$this->view = "welcome";
		$this->load->view($this->view,$this->data);
	}

	public function cek_login($username,$password)
	{
		$this->load->model('akademika_portal');
		$this->data['title'] = 'Debug Page';

		$cek_portal = $this->akademika_portal->get_Login($username,md5($password));

		if($cek_portal)
		{
			foreach($query->result() as $data){
				$sess_data['tusrId'] = $data->tusrNama;
				$sess_data['tusrThakrId'] = $data->tusrThakrId;
				$sess_data['tusrNama'] = $data->tusrProfil;
				$sess_data['kodeProdi'] = $data->tusrProdiKode;
				$sess_data['kodeJur'] = $data->prodiJurKode;
				$sess_data['kodeFak'] = $data->prodiFakKode;

				$this->session->set_userdata('logged_in_dosen',$sess_data);
			}
		} else {}

		$this->load->view('layout/debug');

	}



	public function cek_krs($nim)
	{
		$this->load->model('akademika_sia');
		$this->data['result'] = $this->akademika_sia->total_sks($nim);
		$this->load->view('layout/debug',$this->data);
	}

	public function cek_mk_ta($nim)
	{
		$this->load->model('akademika_sia');
		$this->data['result'] = $this->akademika_sia->cek_krs($nim);
		$this->load->view('layout/debug',$this->data);
	}

	public function mahasiswa()
	{
		$this->data['body_page'] = '';
		$this->load->view('layout/mahasiswa',$this->data);
	}

		public function dosen()
	{
		$this->data['body_page'] = '';
		$this->load->view('layout/dosen',$this->data);
	}

	public function testa(){
		//$result 	= http_response_code(URL_API.'dosen/login?user=197711202010121002&pass=fJu4g6sdMQW');
		//echo $result;

		$result = json_decode(file_get_contents(URL_API.'dosen/login?user=197711202010121002&pass=fJu4g6sdMQW'),1);
		echo $result['status'];
		//echo $result->status;
		//$result2 = get_headers(URL_API.'dosen/login?user=197711202010121002&pass=fJu4g6sdMQW');

		//$result =  (substr(get_headers(URL_API.'dosen/login?user=197711202010121002&pass=fJu4g6sdMQW')[0], 9, 3) == 200 ? TRUE:FALSE);
		//echo $result;
		//echo is_array($result) ? 'Array' : 'not an Array';

		//echo $result['status'];
		//echo $result2;
		//var_dump($result);
		//echo $result[];

					//$result[$key]['judulDsnPengusul'] = json_decode(file_get_contents(URL_API.'dosen?nip='.$result[$key]['judulDsnPengusul']))->nama;
	}

	public function test() {
		$session_data = array(
							'curr_id' => '1',
							'curr_username' => 'admin',
							'curr_group' => 'admin',
							'curr_jurusan' => '',
							'curr_prodi' => '',
						);							
						
		$this->session->set_userdata('logged_in_admin', $session_data);
		$this->load->view('siteview/debug');
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->load->view('debug');
	}

	
}
