<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//* Check if current-user is authorized user *//
		if (!isset($this->session->userdata['logged_in_portal']['auth'])) {
			if (!isset($this->session->userdata['logged_in_portal'])) {
				redirect(site_url('login'));
			} else {
				show_error('Access denied!');
			}
		}

		//* Load model, library, helper, etc *//
		$this->load->model(array('Tabel_dokumen','Tabel_dosen','Tabel_docgroup'));

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

		//* Initialize general variables for pageview properties *//
		$data['pageTitle'] 	= "Repository";
		$data['subtitle'] 	= $this->user['namaunit'];
		$data['body_page'] 	= "body/dokumen/list_with_add_multiple";

		//* Declare variables array $data to be passing to view *//
		$data['dokumen'] 	= $this->Tabel_dokumen->get("ownerId REGEXP '[a-zA-Z]'",'dokumenTahun DESC, dokumenDocgroupId ASC');
		$data['docgroup'] 	= $this->Tabel_docgroup->get();
		$data['ownerId']	= $this->user['kodegrup'];
		$data['fileSpec']	= "Filetype= pdf jpg jpeg xls xlsx mde doc docx; Max Size=20 Mb.";

		switch ($this->user['kodegrup']) {
			case "dekan"		: $data['nodeId'] = '0'; break;
			case "wd1"			: $data['nodeId'] = '1'; break;
			case "wd2"			: $data['nodeId'] = '2'; break;
			case "wd3"			: $data['nodeId'] = '3'; break;
			case "jurusan45"	: $data['nodeId'] = '5'; break;
			case "jurusan42"	: $data['nodeId'] = '6'; break;
			case "jurusan43"	: $data['nodeId'] = '7'; break;
			case "jurusan44"	: $data['nodeId'] = '8'; break;
			case "prodi14"		: $data['nodeId'] = '10'; break;
			case "prodi94"		: $data['nodeId'] = '11'; break;
			case "prodi15"		: $data['nodeId'] = '12'; break;
			case "prodi16"		: $data['nodeId'] = '13'; break;
			case "prodi12"		: $data['nodeId'] = '14'; break;
			case "prodi77"		: $data['nodeId'] = '15'; break;
			case "prodi13"		: $data['nodeId'] = '16'; break;
			default 			: $data['nodeId'] = '17'; break;
		}
		
		//* formatting the data to be view properly at the pageview *//
		foreach ($data['dokumen'] as &$val) {
			$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenFile'];
		}
		
		$this->load->view(THEME,$data);

	}	

	public function dosen($nip=FALSE) {

		if ($nip === FALSE) {
			
			//* Switch data dosen between: prodi, jurusan and fakultas *//
			switch ($this->user['grup']) {

				//* Get data dosen from local database and return to $dosen *//
				case "prodi"	: $data['dosen'] = $this->Tabel_dosen->get(array('kodeProdi' => $this->user['kodeunit'])); break;
				case "jurusan"	: $data['dosen'] = $this->Tabel_dosen->get(array('kodeJurusan' => $this->user['kodeunit'])); break;
				default 		: $data['dosen'] = $this->Tabel_dosen->get(); break;

			}

			//* formatting the data to be view properly at the pageview *//
			foreach ($data['dosen'] as $key => $value) {
				$data['dosen'][$key]['jurusan'] = ucwords(strtolower($value['jurusan']));
				$data['dosen'][$key]['prodi'] = ucwords(strtolower($value['prodi']));
			}

			//* Initialize general variables for pageview properties *//
			$data['pageTitle'] 	= "Dokumen Dosen ". $this->user['namaunit'];
			$data['subtitle'] 	= "Daftar Dosen";
			$data['body_page'] 	= "body/dokumen/list_dosen";

		} else {

			$namaDosen = $this->Tabel_dosen->detail(array('nip' => $nip))['nama'];

			//* Initialize general variables for pageview properties *//
			$data['pageTitle'] 	= "Dokumen ". $this->user['namaunit'];
			$data['subtitle'] 	= "Daftar Dokumen ". $namaDosen;
			$data['body_page'] 	= "body/dokumen/list_without_add";

			//* Declare variables array $data to be passing to view *//
			$data['dokumen'] 	= $this->Tabel_dokumen->user_get(array('aso_dokumen.userId'=> $nip),'dokumenTahun DESC, dokumenDocgroupId ASC');

			//* formatting the data to be view properly at the pageview *//
			foreach ($data['dokumen'] as &$val) {
				$val['dokumenFile'] = URL_DOKUMEN.$val['dokumenFile'];
			}
		}

		$this->load->view(THEME,$data);
	}

	public function tambah() {

		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('nama', 'Nama Dokumen', 'trim|required');
		$this->form_validation->set_rules('dsndoc', 'Tag Dosen', 'required');
		if (empty($_FILES['dokumen']['name'])) {
			$this->form_validation->set_rules('dokumen', 'Upload Dokumen', 'required');
		}		

		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['dokumenNama']		= $this->input->post('nama');
			$database['dokumenDeskripsi']	= $this->input->post('deskripsi');
			$database['dokumenNomor'] 		= $this->input->post('nomor');
			$database['dokumenTahun']		= $this->input->post('tahun');
			$database['dokumenDocgroupId'] 	= $this->input->post('jenis');
			$database['ownerId'] 			= $this->user['kodegrup'];

			//* Check if dokumen has submit *//
			if(!empty($_FILES['dokumen']['name'])) {

				//* Set the configuration for upload library. Set the file name. with format idUser-currentDate.jpg *//
				$this->config->config['dokumen_admin']['file_name'] = $this->user['kodegrup']."-".date('Ymd');
				$this->load->library('upload', $this->config->item('dokumen_admin'));

				//* Check if the dokumen has not been upload *//
				if(!$this->upload->do_upload('dokumen')) {
				
					$this->session->set_flashdata('type', 'danger');
					$this->session->set_flashdata('message', $this->upload->display_errors());				
					
				} else {
					//* If the dokumen has been successfully upload *//

					//* Declare var dokumenFile with file name  *//
					$upload_data 				= $this->upload->data();
					$database['dokumenFile'] 	= $upload_data['file_name'];

					//* Add var $database to be input in the database, return insert id*//
					$id_dokumen 	= $this->Tabel_dokumen->tambah($database);

					//* Declare var usertag which will be tag to this dokumen*//
					$usertag = [];
					if ($this->input->post('dsndoc')) {
						$userdsn = explode(",", $this->input->post('dsndoc'));
						foreach ($userdsn as $key) array_push($usertag, $key);
					}
					if ($this->input->post('mhsdoc')) {
						$usermhs = explode(",", $this->input->post('mhsdoc'));
						foreach ($usermhs as $key) array_push($usertag, $key);
					}

					//* Declare array multi_user and formatting data, which will inserted into database*//
					foreach ($usertag as $val) {
						$multi_user[] = array('dokumenId' => $id_dokumen, 'userId' => $val);
					}
					
					//* Input the usertag into database *//
					if ($this->Tabel_dokumen->link_user($multi_user)) {
					
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', 'Berhasil disimpan!');;
						
					} else {
					
						$this->session->set_flashdata('type', 'danger');
						$this->session->set_flashdata('message', 'Gagal disimpan!');
					}
				}
			}

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Gagal disimpan. Form tidak lengkap! '));
		}

		redirect(site_url('dokumen'));

	}

	public function edit() {

		//* Set rules for form validation. Form validation use CI Library *//
		$this->form_validation->set_rules('nama', 'Nama Dokumen', 'trim|required');
		$this->form_validation->set_rules('dsndoc', 'Tag Dosen', 'required');
		
		//* Check if form valid *//
		if ($this->form_validation->run() == TRUE) {

			//* Declare var $database to be input at the database *//
			$database['idDokumen']			= $this->input->post('id');
			$database['dokumenNama']		= $this->input->post('nama');
			$database['dokumenDeskripsi']	= $this->input->post('deskripsi');
			$database['dokumenNomor'] 		= $this->input->post('nomor');
			$database['dokumenTahun']		= $this->input->post('tahun');
			$database['dokumenDocgroupId'] 	= $this->input->post('jenis');
			$database['userUpdate']			= $this->user['nama'];

			//* If new dokumen is submitted, perform below procedure. If not, do nothing *//
			if(!empty($_FILES['dokumen']['name'])) {

				//* Set the configuration for upload library. Set the file name. with format idUser-currentDate.jpg *//
				$this->config->config['dokumen_admin']['file_name'] = $this->user['kodegrup']."-".date('Ymd');
				$this->load->library('upload', $this->config->item('dokumen_admin'));

				//* Check if the dokumen has not been upload *//
				if(!$this->upload->do_upload('dokumen')) {
				
					$this->session->set_flashdata('type', 'danger');
					$this->session->set_flashdata('message', $this->upload->display_errors());				
					
				} else {
					//* If the dokumen has been successfully upload *//

					//* Delete the old dokumen file*//
					$file = $this->Tabel_dokumen->detail(array('idDokumen' => $database['idDokumen']));
					if (file_exists(FCPATH.DIR_DOKUMEN.$file['dokumenFile'])) unlink(FCPATH.DIR_DOKUMEN.$file['dokumenFile']);

					//* Get the new dokumen file name, to be inserted at the database*//
					$upload_data 				= $this->upload->data();
					$database['dokumenFile'] 	= $upload_data['file_name'];
				}
			}

			//* Add var $database to be update in the database*//
			if ($this->Tabel_dokumen->update($database)) {

				//* If the database has been updated successfully *//

				//* Declare new usertag which will be tag to this dokumen*//
				$user = [];
				if ($this->input->post('dsndoc')) {
					$userdsn = explode(",", $this->input->post('dsndoc'));
					foreach ($userdsn as $key) array_push($user, $key);
				}
				if ($this->input->post('mhsdoc')) {
					$usermhs = explode(",", $this->input->post('mhsdoc'));
					foreach ($usermhs as $key) array_push($user, $key);
				}

				//* Declare array multi_user and formatting data, which will inserted into database*//
				foreach ($user as $val) {
					$multi_user[] = array('dokumenId' => $database['idDokumen'], 'userId' => $val);
				}

				//* Delete the old usertag*//
				$this->Tabel_dokumen->delete_alluser($database['idDokumen']);

				//* Insert the new usertag*//
				if ($this->Tabel_dokumen->link_user($multi_user)) {
					
					$this->session->set_flashdata('type', 'success');
					$this->session->set_flashdata('message', 'Berhasil disimpan!');;
					
				} else {
				
					$this->session->set_flashdata('type', 'danger');
					$this->session->set_flashdata('message', 'Gagal disimpan!');
				}

			} else {
			
				$this->session->set_flashdata('type', 'danger');
				$this->session->set_flashdata('message', 'Gagal diupdate!');
			}	

		} else {

			$this->session->set_flashdata('type', 'warning');
			$this->session->set_flashdata('message', validation_errors('Form tidak lengkap! '));
		}

		redirect(site_url('dokumen'));
	
	}

	public function delete() {

		$id_dokumen = $this->input->post('id');

		//* Get detail dokumen with id = $id_dokumen *//
		$file = $this->Tabel_dokumen->detail(array('ft_dokumen.idDokumen' => $id_dokumen));

		//* Delete dokumen file*//
		if (file_exists(FCPATH.DIR_DOKUMEN.$file['dokumenFile'])) unlink(FCPATH.DIR_DOKUMEN.$file['dokumenFile']);

		//* Delete entry in database *//
		if ($this->Tabel_dokumen->delete($id_dokumen)) {
				
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
		$output 		= $this->Tabel_dokumen->detail(array('idDokumen'=> $id));
		$output['user'] = $this->Tabel_dokumen->user_get(array('idDokumen'=> $id));

		//* formatting the data to be view properly at the output *//
		foreach ($output['user'] as &$key) {
			//* Get data user from API. nama, id, tipe *//
			$key['detail'] = $this->apicall->get(URL_API.'daftar/user/'.$key['userId']);
		}
		
		echo json_encode($output);

	}
	
}