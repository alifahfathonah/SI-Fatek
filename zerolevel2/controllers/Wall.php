<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wall extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		//* Check if current-user is logged user *//
		if (!isset($this->session->userdata['logged_in_portal'])) {
			redirect(site_url('login'));
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_announce', 'Tabel_dosen', 'Tabel_pegawai')); 

		//* Initialize class variables. current-user identity. To be used throughout this class *//
		if (isset($this->session->userdata['logged_in_portal']['dosen'])) {
			$this->user = array(
			'id' 		=> $this->session->userdata['logged_in_portal']['dosen']['userid'],	
			'kodeProdi' => $this->session->userdata['logged_in_portal']['dosen']['kodeProdi'],
			'kodeJur'	=> $this->session->userdata['logged_in_portal']['dosen']['kodeJur'],
			);
		}

		if (isset($this->session->userdata['logged_in_portal']['mhs'])) {
			$this->user = array(
			'id' 		=> $this->session->userdata['logged_in_portal']['mhs']['userid'],	
			'kodeProdi' => $this->session->userdata['logged_in_portal']['mhs']['kodeProdi'],
			'kodeJur'	=> $this->session->userdata['logged_in_portal']['mhs']['kodeJur'],
			);
		}

		if (isset($this->session->userdata['logged_in_portal']['pgw'])) {
			$this->user = array(
			'id' 		=> $this->session->userdata['logged_in_portal']['pgw']['userid'],	
			'kodeProdi' => "",
			'kodeJur'	=> "",
			);
		}

		if (isset($this->session->userdata['logged_in_portal']['auth'])) {
			$this->admin['userid'] = $this->session->userdata['logged_in_portal']['auth']['userid'];
			$this->admin['nama'] = $this->session->userdata['logged_in_portal']['auth']['nama'];
			$this->admin['posisi'] = $this->session->userdata['logged_in_portal']['auth']['posisi'];
			$this->admin['foto'] = $this->session->userdata['logged_in_portal']['foto'];
			if ($this->session->userdata['logged_in_portal']['auth']['grup'] == "jurusan" OR $this->session->userdata['logged_in_portal']['auth']['grup'] == "prodi") {
				$this->admin['kodeGrup'] = $this->session->userdata['logged_in_portal']['auth']['kodeGrup'];
			} else {
				$this->admin['kodeGrup'] = "fakultas";
			}
		}
	}

	public function index() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Pengumuman";
		$data['body_page'] 	= "body/dashboard/wall";

		//* Get data from tabel announce and store at $announce *//
		//$data['announce']	= (isset($this->admin)) ? $this->Tabel_announce->get(FALSE,'tanggal DESC') : $this->Tabel_announce->get("grups = 'fakultas' OR grups ='".$this->user['kodeJur']."' OR grups ='".$this->user['kodeProdi']."'",'tanggal DESC');

		$data['announce']	= $this->Tabel_announce->get("grups = 'fakultas' OR grups ='".$this->user['kodeJur']."' OR grups ='".$this->user['kodeProdi']."'",'tanggal DESC');

		$data['bday']	= $this->Tabel_dosen->get("DATE_FORMAT((tglLahir),'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
		//$data['bday2']	= $this->Tabel_pegawai->get("DATE_FORMAT((tglLahir),'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");

		//* formatting the data to be view properly at the pageview *//
		foreach ($data['announce'] as &$val) {
			$val['tanggal'] 	= date('D, M j Y, g:i a',strtotime($val['tanggal']));
			$val['url'] 		= site_url('detail/dosen/') . $val['username'];

			if ($val['file']) {
				$val['file'] 	= explode(" ", $val['file']);
				foreach ($val['file'] as &$dok) $dok = URL_DOKUMEN_TMP . $dok;
			}

			//* setting priviledge to edit or delete some posting *//
			$val['owner'] 		= ($val['postBy'] == $this->user['id'] ) ? TRUE : FALSE;
		}

		//* setting authorized to adding post *//
		$data['authorized'] 	= (isset($this->admin['userid'])) ? TRUE : FALSE;

		$this->load->view(THEME,$data);
	}

	public function add_post() {

		$this->form_validation->set_rules('announce', 'Isi Pengumuman', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['postBy']		= $this->admin['userid'];
			$database['content'] 	= $this->input->post('announce');
			$database['grups']		= $this->admin['kodeGrup'];
			$database['subtitle']	= $this->admin['posisi'];
			$database['nama']		= $this->admin['nama'];
			$database['pic']		= $this->admin['foto'];

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = "announce-".date('Ymd');
					$this->load->library('upload', $this->config->item('dokumen_tmp'));

					if(!$this->upload->do_upload('dokumens')) {

						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', $this->upload->display_errors());				
					
					} else {
						$filename[$i] 	= $this->upload->data()['file_name'];
					}
				}
				$database['file']= implode(" ", $filename);

			}

			if ($this->Tabel_announce->tambah($database)) {

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

		redirect(site_url('wall'));
	
	}

	public function update_post() {

		$this->form_validation->set_rules('announce', 'Isi Pengumuman', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {

			$database['idAnnounce'] = $this->input->post('id');
			$database['content'] 	= $this->input->post('announce');

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = "announce-".date('Ymd');
					$this->load->library('upload', $this->config->item('dokumen_tmp'));

					if(!$this->upload->do_upload('dokumens')) {

						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', $this->upload->display_errors());				
					
					} else {
						$filename[$i] 	= $this->upload->data()['file_name'];
					}
				}
				$database['file']= implode(" ", $filename);

				//* Delete the old file attachment *//
				$announce 	= $this->Tabel_announce->detail(array('idAnnounce' => $database['idAnnounce']));
				if ($announce['file']) {
					$announce['file'] = explode(" ", $announce['file']);
					foreach ($announce['file'] as $key => $value) {
						unlink(FCPATH.DIR_DOKUMEN_TMP.$value);
					}
				}
			}

			if ($this->Tabel_announce->update($database)) {

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

		redirect(site_url('wall'));
	
	}	

	public function detail_post($id) {

		$output = $this->Tabel_announce->detail(array('idAnnounce'=> $id));
		echo json_encode($output);

	}		

	public function delete_post() {

		$id 	= $this->input->post('id');

		$file 	= explode(" ", $this->Tabel_announce->detail(array('idAnnounce' => $id))['file']);

		foreach ($file as $key) {
			if (!empty($key)) unlink(FCPATH.DIR_DOKUMEN_TMP . $key);
		}

		//* Delete entry in database *//
		if ($this->Tabel_announce->delete($id)) {
				
			$this->session->set_flashdata('type', 'success');
			$this->session->set_flashdata('message', 'Berhasil dihapus!');

		} else {
		
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('message', 'Gagal dihapus!');
			$this->output->set_status_header('500');
		}

	}

	public function about() {

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "About Portal Fatek";
		$data['body_page'] 	= "body/description";

		$this->load->view(THEME,$data);
	}	

}