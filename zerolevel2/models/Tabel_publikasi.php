<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_publikasi extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_publikasi');
		$result = $query->result_array();

		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ft_publikasi');
		$result = $query->row_array();
		
		return $result;
	}
	
	public function tambah($data) {

		$this->db->insert('ft_publikasi', $data);
		return $this->db->affected_rows();
	}
	
	public function delete($id) {

		$this->db->delete('ft_publikasi', array('publikasiId' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {
		
		$this->db->where('publikasiId', $data['publikasiId']);
		$this->db->update('ft_publikasi', $data);
		return $this->db->affected_rows();
	}
	
}