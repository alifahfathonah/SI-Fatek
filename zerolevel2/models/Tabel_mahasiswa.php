<?php
class Tabel_mahasiswa extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
	
		$this->db->join('ref_jurusan', 'ft_mahasiswa.jurusanId = ref_jurusan.idJurusan');
		$this->db->join('ref_prodi', 'ft_mahasiswa.prodiId = ref_prodi.idProdi');
		$this->db->where('status = 2');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_mahasiswa');
		$result = $query->result_array();
		return $result;
	}
	
	public function detail($condition) {
	
		$this->db->join('ref_jurusan', 'ft_mahasiswa.jurusanId = ref_jurusan.idJurusan');
		$this->db->join('ref_prodi', 'ft_mahasiswa.prodiId = ref_prodi.idProdi');	
		$this->db->where($condition);
		$query = $this->db->get('ft_mahasiswa');
		$result = $query->row_array();

		return $result;
	}	
	
	public function tambah($data) {
		$this->db->insert('ft_mahasiswa', $data);
		return $this->db->insert_id();
	}
	
	public function delete($id) {
		return $this->db->delete('ft_mahasiswa', array('idMahasiswa' => $id));
	}
	
	public function update($data) {
		$this->db->where('nim', $data['nim']);
		return $this->db->update('ft_mahasiswa', $data);
	}		
	
	
}