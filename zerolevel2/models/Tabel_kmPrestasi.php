<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_kmPrestasi extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function user_get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		$this->db->where("aso_misc.jenis = 'prestasi'");
		$this->db->join('ft_mahasiswa', 'nim = userId','left');
		$this->db->join('km_prestasi', 'idPrestasi = jenisId');
		$this->db->join('ref_jurusan', 'ft_mahasiswa.jurusanId = ref_jurusan.idJurusan','left');
		$this->db->join('ref_prodi', 'ft_mahasiswa.prodiId = ref_prodi.idProdi','left');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('aso_misc');
		$result = $query->result_array();
		//print_r($this->db->last_query()); die;
		return $result;
	
	}	

	public function get($condition = FALSE, $sort = FALSE, $groupby = FALSE, $having = FALSE) {
		
		$this->db->join('ft_mahasiswa', 'nim = proposedBy','left');
		if ($sort) $this->db->order_by($sort);
		if ($groupby) $this->db->group_by($groupby);
		if ($having) $this->db->having($having);
		if ($condition) $this->db->where($condition);
		
		$query = $this->db->get('km_prestasi');
		$result = $query->result_array();
		//print_r($this->db->last_query()); die;
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$this->db->join('ft_mahasiswa', 'nim = proposedBy','left');
		$query = $this->db->get('km_prestasi');
		$result = $query->row_array();

		return $result;
	}	

	public function tambah($data, $usertag) {

		$this->db->insert('km_prestasi', $data);
		$idPrestasi = $this->db->insert_id();
		
		foreach ($usertag as $key => $value) {
			$data2[$key]['jenis']	= 'prestasi';
			$data2[$key]['jenisId']	= $idPrestasi;
			$data2[$key]['userId']	= $value;
		}

		return $this->tambah_aso($data2);
	}

	public function tambah_aso($data) {
		$this->db->trans_start();
		foreach ($data as $trans) {
			$this->db->insert('aso_misc', $trans);
		}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function delete($id) {
		$this->delete_aso_all($id);
		$this->db->delete('km_prestasi', array('idPrestasi' => $id));
		return $this->db->affected_rows();
	}

	public function delete_aso($data) {
		$this->db->where($data);
		$this->db->where("aso_misc.jenis = 'prestasi'");
		$this->db->delete('aso_misc');
		return $this->db->affected_rows();
	}

	public function delete_aso_all($id) {
		$this->db->where("aso_misc.jenis = 'prestasi'");
		return $this->db->delete('aso_misc', array('jenisId' => $id));
	}

	public function update_status($data) {

		$this->db->where('idPrestasi', $data['idPrestasi']);

		return $this->db->update('km_prestasi', $data);
	}	
	
	public function update($data,$data2) {

		$this->db->where('idPrestasi', $data['idPrestasi']);
		$this->db->update('km_prestasi', $data);

		$data2['jenisId'] = $data['idPrestasi'];
		return $this->update_aso($data2);

	}

	public function update_aso($data) {
		//echo var_dump($data);die;
		$this->delete_aso_all($data['jenisId']);

		foreach ($data['usertag'] as $key => $value) {
			$data2[$key]['jenis']	= 'prestasi';
			$data2[$key]['jenisId']	= $data['jenisId'];
			$data2[$key]['userId']	= $value;
		}

		return $this->tambah_aso($data2);
	}	

}

		//echo var_dump($result);die;
		//print_r($this->db->last_query()); die;
