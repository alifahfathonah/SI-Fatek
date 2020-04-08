<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends CI_Controller {
	
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
		$this->load->model(array('Tabel_kmPrestasi')); 

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
		
		$data['pageTitle'] 	= "Daftar Prestasi";
		$data['body_page'] 	= "body/kemahasiswaan/prestasi/list_wd3";

		$data['prestasi'] 	= $this->Tabel_kmPrestasi->get(array('status'=> 'Sudah diverifikasi'),'tglLomba DESC');
		$data['fileSpec']	= "Filetype = pdf jpg jpeg; Max Size = 3 Mb.";

		foreach ($data['prestasi'] as &$val) {
			$val['bukti'] 		= explode(" ", $val['bukti']);
			foreach ($val['bukti'] as &$dok) {
				$dok = URL_DOKUMEN_TMP . $dok;
			}
			$val['tglLomba'] 	= date('d M Y',strtotime($val['tglLomba']));

			$val['mahasiswa'] 	= $this->Tabel_kmPrestasi->user_get(array('jenisId' => $val['idPrestasi']));

			//because sometimes mahasiswa belum ada data didatabase fatek
			foreach ($val['mahasiswa'] as &$key) {
				$key['nama'] 	= (!empty($key['nama'])) ? $key['nama'] : $key['userId'];
				$key['nim'] 	= (!empty($key['nim'])) ? $key['nim'] : $key['userId'];
			}

		}
		
		$this->load->view(THEME,$data);

	}

	public function tambah() {

		$this->form_validation->set_rules('prestasi', 'Prestasi', 'trim|required');
		$this->form_validation->set_rules('even', 'Event', 'trim|required');
		$this->form_validation->set_rules('tglLomba', 'Tanggal', 'required');
		$this->form_validation->set_rules('mhsdoc', 'Tag Mahasiswa', 'required');
		if (empty($_FILES['dokumen']['name'][0])) {
		 	$this->form_validation->set_rules('dokumen', 'Dokumen Pendukung', 'required');
		}

		if ($this->form_validation->run() == TRUE) {

			$database['prestasi'] 	= $this->input->post('prestasi');
			$database['even']		= $this->input->post('even');
			$database['tglLomba'] 	= $this->input->post('tglLomba');
			$database['tingkat'] 	= $this->input->post('tingkat');
			$database['proposedBy'] = $this->user['kodegrup'];
			$database['status'] 	= 'Sudah diverifikasi';

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = "prestasi-".date('Ymd');
					$this->load->library('upload', $this->config->item('dokumen_tmp'));

					if(!$this->upload->do_upload('dokumens')) {

						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', $this->upload->display_errors());				
					
					} else {
						$filename[$i] 	= $this->upload->data()['file_name'];
					}
				}
				$database['bukti']= implode(" ", $filename);
			}

			//* Declare var usertag which will be tag to this prestasi*//
			$usertag = explode(",", $this->input->post('mhsdoc'));

			if ($this->Tabel_kmPrestasi->tambah($database, $usertag)) {

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

		redirect(site_url('kemahasiswaan/prestasi'));
	
	}

	public function edit() {

		$this->form_validation->set_rules('prestasi', 'Prestasi', 'trim|required');
		$this->form_validation->set_rules('even', 'Event', 'trim|required');
		$this->form_validation->set_rules('tglLomba', 'Tanggal', 'required');
		$this->form_validation->set_rules('mhsdoc', 'Tag Mahasiswa', 'required');

		if ($this->form_validation->run() == TRUE) {

			$database['idPrestasi']	= $this->input->post('id');
			$database['prestasi'] 	= $this->input->post('prestasi');
			$database['even']		= $this->input->post('even');
			$database['tglLomba'] 	= $this->input->post('tglLomba');
			$database['tingkat'] 	= $this->input->post('tingkat');

			if(!empty($_FILES['dokumen']['name'][0])) {

				$filecount = count($_FILES['dokumen']['name']);

				for ($i=0; $i<$filecount; $i++) {
					$_FILES['dokumens']['name']		= $_FILES['dokumen']['name'][$i];
					$_FILES['dokumens']['type']		= $_FILES['dokumen']['type'][$i];
					$_FILES['dokumens']['tmp_name']	= $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['dokumens']['error']	= $_FILES['dokumen']['error'][$i];
					$_FILES['dokumens']['size']		= $_FILES['dokumen']['size'][$i];

					$this->config->config['dokumen_tmp']['file_name'] = "prestasi-".date('Ymd');
					$this->load->library('upload', $this->config->item('dokumen_tmp'));

					if(!$this->upload->do_upload('dokumens')) {

						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', $this->upload->display_errors());				
					
					} else {
						//* If the dokumen has been successfully upload *//

						//* Get the new dokumen file name, to be inserted at the database*//
						$upload_data 	= $this->upload->data();
						$filename[$i] 	= $this->upload->data()['file_name'];
					}
				}

			//* Delete the old dokumen file*//
			$file = $this->Tabel_kmPrestasi->detail(array('idPrestasi' => $database['idPrestasi']));
			$file['bukti'] 		= explode(" ", $file['bukti']);

			foreach ($file['bukti'] as $key => $value) {
				if (file_exists(FCPATH.DIR_DOKUMEN_TMP.$value)) unlink(FCPATH.DIR_DOKUMEN_TMP.$value);
			}
			$database['bukti']= implode(" ", $filename);
			
			}

			//* Declare var usertag which will be tag to this prestasi*//
			$database2['usertag'] = explode(",", $this->input->post('mhsdoc'));

			if ($this->Tabel_kmPrestasi->update($database, $database2)) {

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

		redirect(site_url('kemahasiswaan/prestasi'));
	
	}

	public function delete() {

		$id = $this->input->post('id');

		//* Delete the old dokumen file*//
		$file = $this->Tabel_kmPrestasi->detail(array('idPrestasi' => $id));
		$file['bukti'] 		= explode(" ", $file['bukti']);

		//* Delete each dokumen file*//
		foreach ($file['bukti'] as $key => $value) {
			if (file_exists(FCPATH.DIR_DOKUMEN_TMP.$value)) unlink(FCPATH.DIR_DOKUMEN_TMP.$value);
		}

		//* Delete entry in database *//
		if ($this->Tabel_kmPrestasi->delete($id)) {
				
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
		$output 		= $this->Tabel_kmPrestasi->detail(array('idPrestasi'=> $id));
		$output['user'] = $this->Tabel_kmPrestasi->user_get(array('idPrestasi'=> $id));

		//* formatting the data to be view properly at the output *//
		foreach ($output['user'] as &$key) {
			//* Get data user from API. nama, id, tipe *//
			$key['detail'] = $this->apicall->get(URL_API.'daftar/user/'.$key['userId']);
		}
		
		echo json_encode($output);

	}

	public function verifikasi() {
		
		$data['pageTitle'] 	= "Verifikasi Ajuan Prestasi";
		$data['body_page'] 	= "body/kemahasiswaan/prestasi/list_verifikasi";

		$data['prestasi'] 	= $this->Tabel_kmPrestasi->get(array('status'=> 'Diajukan - Menunggu verifikasi WD3'),'tglLomba ASC');
		$data['fileSpec']	= "Filetype = pdf jpg jpeg; Max Size = 3 Mb.";

		foreach ($data['prestasi'] as &$val) {
			$val['bukti'] 		= explode(" ", $val['bukti']);
			foreach ($val['bukti'] as &$dok) {
				$dok = URL_DOKUMEN_TMP . $dok;
			}
			$val['tglLomba'] 	= date('d M Y',strtotime($val['tglLomba']));

			$val['mahasiswa'] 	= $this->Tabel_kmPrestasi->user_get(array('jenisId' => $val['idPrestasi']));

			//because sometimes mahasiswa belum ada data didatabase fatek
			foreach ($val['mahasiswa'] as &$key) {
				$key['nama'] 	= (!empty($key['nama'])) ? $key['nama'] : $key['userId'];
				$key['nim'] 	= (!empty($key['nim'])) ? $key['nim'] : $key['userId'];
			}

		}
		
		$this->load->view(THEME,$data);

	}

	public function detail_approval($id) {

		$id = explode("-", $id);

		for ($i=0; $i<count($id); $i++)  {
			$data[$i] = $this->Tabel_kmPrestasi->detail(array('idPrestasi'=> $id[$i]));
			$output[$i]['item1'] = $data[$i]['nama'];
			$output[$i]['item2'] = $data[$i]['prestasi'];
			$output[$i]['item3'] = $data[$i]['even'];
			$output[$i]['item4'] = $data[$i]['tglLomba'];
		}
		
		echo json_encode($output);

	}

	public function approve() {

		$id = $this->input->post('id');
		$idPrestasi = explode("-", $id);

		foreach ($idPrestasi as $key) {

			$database[$key]['idPrestasi']	= $key;
			$database[$key]['status']		= "Sudah diverifikasi";

			$this->Tabel_kmPrestasi->update_status($database[$key]);
		}

		redirect(site_url('kemahasiswaan/prestasi/verifikasi'));
	}

	public function reject() {

		$id = $this->input->post('id');
		$idPrestasi = explode("-", $id);

		foreach ($idPrestasi as $key) {

			$database[$key]['idPrestasi']	= $key;
			$database[$key]['status']		= "Ditolak - perbaiki kekurangan";

			$this->Tabel_kmPrestasi->update_status($database[$key]);
		}

		redirect(site_url('kemahasiswaan/prestasi/verifikasi'));
	}	

}