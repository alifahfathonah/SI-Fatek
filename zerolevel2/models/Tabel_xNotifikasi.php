<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_xNotifikasi extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($select = FALSE, $condition = FALSE, $sort = FALSE, $groupby = FALSE) {
		if ($select) $this->db->select($select);
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($groupby) $this->db->group_by($groupby);
		$query = $this->db->get('x_notification');
		$result = $query->result_array();
		
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('x_notification');
		$result = $query->row_array();
		
		return $result;
	}	

	public function tambah($data) {

		return $this->db->insert('x_notification', $data);
	}
	
	public function delete($id) {

		$this->db->delete('x_notification', array('idNotif' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {

		$this->db->where('idNotif', $data['idNotif']);
		$this->db->update('x_notification', $data);
		return $this->db->affected_rows();
	}

	public function set_read($id) {

		$data['unread'] = '0';
		$this->db->where('idNotif', $id);
		$this->db->update('x_notification', $data);
		return $this->db->affected_rows();
	}

}
