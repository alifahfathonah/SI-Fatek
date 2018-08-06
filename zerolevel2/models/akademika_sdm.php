<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class akademika_sdm extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->dbSdm = $this->load->database('akademika_sdm', TRUE);
	}


}