<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_docgroup extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ref_docgroup');
		$result = $query->result_array();
		
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ref_docgroup');
		$result = $query->row_array();
		
		return $result;
	}	

	public function tambah($data) {

		return $this->db->insert('ref_docgroup', $data);
	}
	
	public function delete($id) {

		$this->db->delete('ref_docgroup', array('idDocgroup' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {

		$this->db->where('idDocgroup', $data['idDocgroup']);
		$this->db->update('ref_docgroup', $data);
		return $this->db->affected_rows();
	}	

}
