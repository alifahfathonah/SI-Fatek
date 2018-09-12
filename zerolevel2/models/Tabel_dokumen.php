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

}