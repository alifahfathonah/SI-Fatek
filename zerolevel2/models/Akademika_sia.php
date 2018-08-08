<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Model class for querying to akademika_sia database
class akademika_sia extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->dbSia = $this->load->database('akademika_sia', TRUE);
		
	}

	//Function untuk mengambil data total sks dan IPK dari mahasiswa $nim
	function total_sks($nim){
		$this->dbSia->from('mahasiswa');
		$this->dbSia->where('mhsNiu', $nim);
		$this->dbSia->select('mhsNiu AS nim, mhsSksTranskrip AS sks_total, ROUND(mhsIpkTranskrip,2) AS ipk');
		$query = $this->dbSia->get();
		return $query->row_array();
	}

	//Function untuk mengecek apakah sudah mengontrak mata kuliah Tugas Akhir
	function cek_mk_ta($nim){
		$data = "SELECT    b.krsMhsNiu, d.sempSemId, c.mkkurKode, c.mkkurNamaResmi, SUM(a.krsdtSksMatakuliah) AS 'sks_kontrak', IF(b.krsApprovalKe != '0', 'Sudah', 'Belum') AS 'approve'
		FROM akademika_sia.s_krs_detil a
		LEFT JOIN akademika_sia.s_krs b ON b.krsId = a.krsdtKrsId
		LEFT JOIN akademika_sia.s_matakuliah_kurikulum c ON c.mkkurId = a.krsdtMkkurId
		LEFT JOIN akademika_sia.s_semester_prodi d ON d.sempId = b.krsSempId
		LEFT JOIN akademika_sia.s_kelas e ON e.klsId = a.krsdtKlsId
		WHERE d.sempIsAktif    =    '1'
		AND a.krsdtIsBatal    =    '0'
		AND e.klsIsBatal    =    '0'
		AND (c.mkkurNamaResmi LIKE '%TESIS%' OR c.mkkurNamaResmi LIKE 'Tugas%Akhir%' OR c.mkkurNamaResmi LIKE 'THESIS%'
		OR c.mkkurNamaResmi LIKE '%SKRIPSI%' OR c.mkkurNamaResmi LIKE 'KOMPREHENSIF%')
		AND b.krsMhsNiu        LIKE    '$nim';";
		$query = $this->dbSia->query($data);
		return $query->row_array();
	}

   function cek_krs($nim){
      
      $data = "SELECT    b.krsMhsNiu, c.sempSemId, SUM(a.krsdtKrsId) AS 'sks_kontrak'
      FROM akademika_sia.s_krs_detil a
      LEFT JOIN akademika_sia.s_krs b ON b.krsId = a.krsdtKrsId
      LEFT JOIN akademika_sia.s_semester_prodi c ON c.sempId = b.krsSempId
      WHERE c.sempIsAktif    =    '1'
      AND b.krsMhsNiu        LIKE    '$nim'";
      $query = $this->dbSia->query($data);
		return $query->row_array();
    }

}
