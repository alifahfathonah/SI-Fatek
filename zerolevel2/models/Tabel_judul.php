<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Model class for querying to akademika_sia database
class Tabel_judul extends CI_Model {
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		$this->db->join('ref_labstudio', 'ft_judul.kodeLabStudio = ref_labstudio.kodeLabStudio','left');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_judul');
		$result = $query->result_array();

		foreach ($result as $key => $value) {
			$result[$key]['tglUsul'] = ($result[$key]['tglUsul'] != 0 ? tgl_indo($result[$key]['tglUsul']) :"");
			$result[$key]['keyword'] = str_replace(',', ', ', $result[$key]['keyword']);
		}
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$this->db->join('ref_labstudio', 'ft_judul.kodeLabStudio = ref_labstudio.kodeLabStudio','left');
		$query = $this->db->get('ft_judul');
		$result = $query->row_array();

		$result['tglUsul'] = ($result['tglUsul'] != 0 ? tgl_indo($result['tglUsul']) :"");
		$result['keyword'] = str_replace(',', ', ', $result['keyword']);
		
		return $result;
		
	}	

	public function tambah($data) {
		$this->db->insert('ft_judul', $data);
		return $this->db->insert_id();
	}
	
	public function delete($id) {
		return $this->db->delete('ft_judul', array('idJudul' => $id));
	}
	
	public function update($data) {
		$this->db->where('ft_judul', $data['idJudul']);
		return $this->db->update('ft_judul', $data);
	}

}
