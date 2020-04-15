<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_pegawai extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$this->db->where('status = 1');

		$query = $this->db->get('ft_pegawai');
		$result = $query->result_array();

		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ft_pegawai');
		$result = $query->row_array();
		
		return $result;
	}	

	public function tambah($data) {

		$this->db->insert('ft_pegawai', $data);
		return $this->db->affected_rows();
	}
	
	public function delete($id) {
		
		$this->db->delete('ft_pegawai', array('idPegawai' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {

		$this->db->where('idPegawai', $data['idPegawai']);
		$this->db->update('ft_pegawai', $data);
		return $this->db->affected_rows();
	}

	public function check_login($username,$pass) {
		$this->db->where(array('nip' => $username, 'password' => md5($pass)));
		$query = $this->db->get('ft_pegawai');
		$result = $query->row_array();
		
		return $result;
	}

	public function get_pegawai($select = FALSE, $condition = FALSE, $sort = FALSE, $groupby = FALSE, $having = FALSE) {

		if ($select)	$this->db->select($select);
		if ($condition)	$this->db->where($condition);
		if ($sort) 		$this->db->order_by($sort);
		if ($groupby) 	$this->db->group_by($groupby);
		if ($having) 	$this->db->having($having);
		
		$query = $this->db->get('ft_pegawai');
		$result = $query->result_array();
		//print_r($this->db->last_query()); die;
		
		return $result;
	}

}
