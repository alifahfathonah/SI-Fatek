<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel_proposal extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($condition = FALSE, $sort = FALSE, $groupby = FALSE, $having = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($groupby) $this->db->group_by($groupby);
		if ($having) $this->db->having($having);

		$this->db->join('ft_mahasiswa', 'ft_mahasiswa.nim = ak_proposal.nim');
		$this->db->join('ref_jurusan', 'ft_mahasiswa.jurusanId = ref_jurusan.idJurusan');
		$this->db->join('ref_prodi', 'ft_mahasiswa.prodiId = ref_prodi.idProdi');
		$query = $this->db->get('ak_proposal');
		$result = $query->result_array();
		
		return $result;
	}

	public function list($condition = FALSE, $sort = FALSE, $groupby = FALSE, $having = FALSE) {
		if ($condition) $this->db->where($condition);
		if ($sort) $this->db->order_by($sort);
		if ($groupby) $this->db->group_by($groupby);
		if ($having) $this->db->having($having);

		$this->db->join('aso_history', 'ak_proposal.idProposal = aso_history.activityId');
		$this->db->join('ft_mahasiswa', 'ft_mahasiswa.nim = ak_proposal.nim');
		$this->db->join('ref_jurusan', 'ft_mahasiswa.jurusanId = ref_jurusan.idJurusan');
		$this->db->join('ref_prodi', 'ft_mahasiswa.prodiId = ref_prodi.idProdi');
		$query = $this->db->get('ak_proposal');
		$result = $query->result_array();
		
		return $result;
	}	

	public function detail($condition) {
		$this->db->where($condition);
		$this->db->join('ft_mahasiswa', 'ft_mahasiswa.nim = ak_proposal.nim');
		$this->db->join('ref_jurusan', 'ft_mahasiswa.jurusanId = ref_jurusan.idJurusan');
		$this->db->join('ref_prodi', 'ft_mahasiswa.prodiId = ref_prodi.idProdi');
		$query = $this->db->get('ak_proposal');
		$result = $query->row_array();

		return $result;
	}	

	public function tambah($data, $data2) {

		$this->db->insert('ak_proposal', $data);
		$data2['activityId'] = $this->db->insert_id();

		$this->db->insert('aso_history', $data2);
		return $this->db->affected_rows();
	}

	public function tambah_history($data) {
		$this->db->trans_start();
		foreach ($data as $trans) {
			$this->db->insert('aso_history', $trans);
		}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function delete($id) {

		$this->db->delete('ak_proposal', array('idProposal' => $id));
		return $this->db->affected_rows();
	}

	public function delete_history($id) {
		$this->db->delete('aso_history', array('activityId' => $id));
		return $this->db->affected_rows();
	}
	
	public function update($data) {
		
		$this->db->where('idProposal', $data['idProposal']);
		$this->db->update('ak_proposal', $data);
		return $this->db->affected_rows();
	}	

}

		//echo var_dump($result);die;
		//print_r($this->db->last_query()); die;
