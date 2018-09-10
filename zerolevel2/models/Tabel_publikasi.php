<?php
class Tabel_publikasi extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get($id) {
		$this->db->where('dosenId',$id);
		$this->db->order_by('tahun','DESC');
		$query = $this->db->get('ft_publikasi');
		return $query->result_array();
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