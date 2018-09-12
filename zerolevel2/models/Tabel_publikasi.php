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

		return $this->db->insert('ft_publikasi', $data);
	}
	
	public function delete($id) {

		return $this->db->delete('ft_publikasi', array('publikasiId' => $id));
	}
	
	public function update($data) {
		
		$this->db->where('publikasiId', $data['publikasiId']);
		return $this->db->update('ft_publikasi', $data);
	}
	
}