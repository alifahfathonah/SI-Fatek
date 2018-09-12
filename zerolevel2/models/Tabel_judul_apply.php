<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_judul_apply extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $limit = FALSE) {
		$this->db->join('ft_judul', 'ft_judul.judulId = ft_judul_apply.applyJudulId');
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get('ft_judul_apply');
		$result = $query->result_array();

		foreach ($result as $key => $value) {
			$result[$key]['applyTgl'] = ($result[$key]['applyTgl'] != 0 ? tgl_indo($result[$key]['applyTgl']) :"");
		}
		return $result;
	}

	public function detail($condition) {
		$this->db->where($condition);
		$this->db->join('ft_judul', 'ft_judul.judulId = ft_judul_apply.applyJudulId');;
		$query = $this->db->get('ft_judul_apply');
		$result = $query->row_array();
		$result += array("applyNamaMhs" => json_decode(file_get_contents(URL_API.'mahasiswa?nim='.$result['applyNim']))->nama);
		$result += array("judulNamaDosen" => json_decode(file_get_contents(URL_API.'dosen?nip='.$result['judulDsnPengusul']))->nama);
		
		return $result;
	}	

	public function tambah($data) {

		return $this->db->insert('ft_judul_apply', $data);
	}
	
	public function delete($id) {
		return $this->db->delete('ft_judul_apply', array('applyId' => $id));
	}
	
	public function update($data) {

		$this->db->where('applyId', $data['applyId']);
		return $this->db->update('ft_judul_apply', $data);
	}	

}
