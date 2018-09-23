<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apicall extends CI_Model {
	
	public function __construct() {
		parent::__construct();	
	}

	public function get($uri) {

		$opt = array (
			'http' => array(
				'method' => 'GET',
				'header' => API_KEY
			)
		);

		$context = stream_context_create($opt);

		try {
			$data = file_get_contents($uri,FALSE,$context);

			if ($data === FALSE) {
				echo "Cannot contact API server";return;
			}
		}

		catch(Exception $e) {
			echo "Not found";die;
		}
	
		return json_decode($data);

	}

}
