<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_user extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('x_user');
		$result = $query->result_array();
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('x_user');
		return $query->row_array();
		
	}	

	public function tambah($data) {

		return $this->db->insert('x_user', $data);
	}
	
	public function delete($id) {

		return $this->db->delete('x_user', array('userId' => $id));
	}
	
	public function update($data) {
		
		$this->db->where('userId', $data['userId']);
		return $this->db->update('x_user', $data);
	}	

}
