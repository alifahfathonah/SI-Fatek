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
		//print_r($this->db->last_query()); die;

		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ft_dosen');
		$result = $query->row_array();
		
		return $result;
	}	

	public function tambah($data) {

		$this->db->insert('ft_dosen', $data);
		return $this->db->affected_rows();
	}
	
	public function delete($id) {
		
		$this->db->delete('ft_dosen', array('idDosen' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {

		$this->db->where('idDosen', $data['idDosen']);
		$this->db->update('ft_dosen', $data);
		return $this->db->affected_rows();
	}

	public function get2() {
		$sql= "SELECT nama FROM ft_dosen";

		$result = $this->db->query($sql);

		//echo var_dump($result->result_array());die;
		//$this->debugSql();
		return $result->result_array();


	}

}
