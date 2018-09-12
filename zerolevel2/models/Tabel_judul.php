<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_judul extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		$this->db->join('ref_labstudio', 'ref_labstudio.labstudioId = ft_judul.judulLabstudioId','left');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_judul');
		$result = $query->result_array();

		foreach ($result as $key => $value) {
			$result[$key]['judulTglUsul'] = ($result[$key]['judulTglUsul'] != 0 ? tgl_indo($result[$key]['judulTglUsul']) :"");
			$result[$key]['judulKeyword'] = str_replace(',', ', ', $result[$key]['judulKeyword']);
		}
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$this->db->join('ref_labstudio', 'ref_labstudio.labstudioId = ft_judul.judulLabstudioId','left');
		$query = $this->db->get('ft_judul');
		$result = $query->row_array();
		$result += array("judulNamaDosen" => json_decode(file_get_contents(URL_API.'dosen?nip='.$result['judulDsnPengusul']))->nama);
		
		return $result;
	}	

	public function tambah($data) {

		$this->db->insert('ft_judul', $data);
		return $this->db->insert_id();
	}
	
	public function delete($id) {
		return $this->db->delete('ft_judul', array('judulId' => $id));
	}
	
	public function update($data) {

		$this->db->where('judulId', $data['judulId']);
		return $this->db->update('ft_judul', $data);
	}

}
