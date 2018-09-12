<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_dokumen extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
	
		$this->db->join('ft_dokumen', 'ft_dokumen.dokumenId = ft_dokumen_user.dokumenId');
		$this->db->join('ref_docgroup', 'ref_docgroup.docgroupId = ft_dokumen.dokumenDocgroupId');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_dokumen_user');
		$result = $query->result_array();
		return $result;
	
	}
	
	public function detail($condition) {
		$this->db->join('ft_dokumen', 'ft_dokumen.dokumenId = ft_dokumen_user.dokumenId');
		$this->db->join('ref_docgroup', 'ref_docgroup.docgroupId = ft_dokumen.dokumenDocgroupId');
		$this->db->where($condition);
		$query = $this->db->get('ft_dokumen_user');
		$result = $query->row_array();
		return $result;
	}

	public function tambah($data) {

		return $this->db->insert('ft_dokumen', $data);
	}	
	
	public function delete($id) {
		return $this->db->delete('ft_dokumen', array('dokumenId' => $id));
	}
	
	public function update($data) {

		$this->db->where('dokumenId', $data['dokumenId']);
		return $this->db->update('ft_dokumen', $data);
	}		
	
	public function link_user($data) {
		$this->db->trans_start();
		foreach ($data as $trans) {
			$this->db->insert('ft_dokumen_user', $trans);
		}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}	
	
	public function unlink_user($dokumenId,$userId) {
		return $this->db->delete('ft_dokumen_user', array('dokumenId' => $idDokumen, 'userId' => $id_user));
	}	

}