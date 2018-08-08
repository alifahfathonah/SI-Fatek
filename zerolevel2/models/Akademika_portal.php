<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akademika_portal extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->dbPortal = $this->load->database('akademika_portal', TRUE);
	}

	function get_login($username, $password) {
		
		$this->dbPortal->where('tusrNama', $username);
		$this->dbPortal->where('tusrPassword', $password);
		//$this->dbPortal->where('tusrProdiKode', '77');
		$this->dbPortal->from('t_user');
		$this->dbPortal->join('program_studi', 't_user.tusrProdiKode = program_studi.prodiKode', 'left');
		$query = $this->dbPortal->get();
		return $query->row_array();
	}


}
