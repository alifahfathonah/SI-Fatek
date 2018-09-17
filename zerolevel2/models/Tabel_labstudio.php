<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_labstudio extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ref_labstudio');
		$result = $query->result_array();
		
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ref_labstudio');
		$result = $query->row_array();
		
		return $result;
	}	

	public function tambah($data) {

		$this->db->insert('ref_labstudio', $data);
		return $this->db->affected_rows();
	}
	
	public function delete($id) {
		
		$this->db->delete('ref_labstudio', array('labstudioId' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {
		
		$this->db->where('labstudioId', $data['labstudioId']);
		$this->db->update('ref_labstudio', $data);
		return $this->db->affected_rows();
	}	

}
