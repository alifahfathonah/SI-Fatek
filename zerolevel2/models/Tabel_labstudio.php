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
		return $query->row_array();
		
	}	

	public function tambah($data) {
		$data += array('userUpdate' => $this->session->userdata['username']);
		$this->db->insert('ref_labstudio', $data);
		return $this->db->insert_id();
	}
	
	public function delete($id) {
		return $this->db->delete('ref_labstudio', array('labstudioKode' => $id));
	}
	
	public function update($data) {
		$data += array('userUpdate' => $this->session->userdata['username']);
		$this->db->where('labstudioKode', $data['labstudioKode']);
		return $this->db->update('ref_labstudio', $data);
	}	

}
