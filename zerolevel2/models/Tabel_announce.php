<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_announce extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		$this->db->join('x_user', 'postBy = username');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_announce');
		$result = $query->result_array();

		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ft_announce');
		$result = $query->row_array();
		
		return $result;
	}
	
	public function tambah($data) {

		$this->db->insert('ft_announce', $data);
		return $this->db->affected_rows();
	}
	
	public function delete($id) {

		$this->db->delete('ft_announce', array('idAnnounce' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {
		
		$this->db->where('idAnnounce', $data['idAnnounce']);
		$this->db->update('ft_announce', $data);
		return $this->db->affected_rows();
	}
	
}