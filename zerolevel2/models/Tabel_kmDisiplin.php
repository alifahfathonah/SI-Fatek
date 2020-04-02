<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_kmDisiplin extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function user_get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		$this->db->where("aso_misc.jenis = 'disiplin'");
		$this->db->join('ft_mahasiswa', 'nim = userId','left');
		$this->db->join('km_disiplin', 'idDisiplin = jenisId');
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
		
		if ($sort) $this->db->order_by($sort);
		if ($groupby) $this->db->group_by($groupby);
		if ($having) $this->db->having($having);
		if ($condition) $this->db->where($condition);
		
		$query = $this->db->get('km_disiplin');
		$result = $query->result_array();
		//print_r($this->db->last_query()); die;
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('km_disiplin');
		$result = $query->row_array();

		return $result;
	}	

	public function tambah($data, $usertag) {

		$this->db->insert('km_disiplin', $data);
		$idDisiplin = $this->db->insert_id();
		
		foreach ($usertag as $key => $value) {
			$data2[$key]['jenis']	= 'disiplin';
			$data2[$key]['jenisId']	= $idDisiplin;
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
		$this->db->delete('km_disiplin', array('idDisiplin' => $id));
		return $this->db->affected_rows();
	}

	public function delete_aso($data) {
		$this->db->where($data);
		$this->db->where("aso_misc.jenis = 'disiplin'");
		$this->db->delete('aso_misc');
		return $this->db->affected_rows();
	}

	public function delete_aso_all($id) {
		$this->db->where("aso_misc.jenis = 'disiplin'");
		return $this->db->delete('aso_misc', array('jenisId' => $id));
	}	
	
	public function update($data,$data2) {

		$this->db->where('idDisiplin', $data['idDisiplin']);
		$this->db->update('km_disiplin', $data);

		$data2['jenisId'] = $data['idDisiplin'];
		return $this->update_aso($data2);

	}

	public function update_aso($data) {
		//echo var_dump($data);die;
		$this->delete_aso_all($data['jenisId']);

		foreach ($data['usertag'] as $key => $value) {
			$data2[$key]['jenis']	= 'disiplin';
			$data2[$key]['jenisId']	= $data['jenisId'];
			$data2[$key]['userId']	= $value;
		}

		return $this->tambah_aso($data2);
	}	

}

		//echo var_dump($result);die;
		//print_r($this->db->last_query()); die;
