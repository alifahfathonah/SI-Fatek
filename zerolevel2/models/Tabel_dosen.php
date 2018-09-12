<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_dosen extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_dosen');
		$result = $query->result_array();

		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ft_dosen');
		$result = $query->row_array();
		
		return $result;
	}	

	public function tambah($data) {

		return $this->db->insert('ft_dosen', $data);
	}
	
	public function delete($id) {
		
		return $this->db->delete('ft_dosen', array('dosenId' => $id));
	}
	
	public function update($data) {

		$this->db->where('dosenId', $data['dosenId']);
		return $this->db->update('ft_dosen', $data);
	}

}
