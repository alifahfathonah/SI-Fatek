<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_dokumen extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function user_get($condition = FALSE, $sort = FALSE, $limit = FALSE, $groupby = FALSE) {
	
		$this->db->join('ft_dokumen', 'ft_dokumen.idDokumen = aso_dokumen.dokumenId');
		$this->db->join('ref_docgroup', 'ref_docgroup.idDocgroup = ft_dokumen.dokumenDocgroupId');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		if ($groupby) $this->db->group_by($groupby);
		
		$query = $this->db->get('aso_dokumen');
		$result = $query->result_array();
		return $result;
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
	
		$this->db->join('ref_docgroup', 'ref_docgroup.idDocgroup = ft_dokumen.dokumenDocgroupId');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);

		$query = $this->db->get('ft_dokumen');
		$result = $query->result_array();
		//print_r($this->db->last_query()); die;

		return $result;
	}
	
	public function detail($condition) {
		$this->db->where($condition);
		$query = $this->db->get('ft_dokumen');
		$result = $query->row_array();
		return $result;
	}

	public function tambah($data) {

		$this->db->insert('ft_dokumen', $data);
		return $this->db->insert_id();
	}

	public function link_user($data) {
		$this->db->trans_start();
		foreach ($data as $trans) {
			$this->db->insert('aso_dokumen', $trans);
		}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function unlink_user($id_dokumen,$id_user) {
		return $this->db->delete('aso_dokumen', array('dokumenId' => $id_dokumen, 'userId' => $id_user));
	}

	public function delete_alluser($id) {
		return $this->db->delete('aso_dokumen', array('dokumenId' => $id));
	}
	
	public function delete($id) {
		$this->delete_alluser($id);
		return $this->db->delete('ft_dokumen', array('idDokumen' => $id));
	}
	
	public function update($data) {
		$this->db->where('idDokumen', $data['idDokumen']);
		return $this->db->update('ft_dokumen', $data);
	}	

}