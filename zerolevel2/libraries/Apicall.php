<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * @package         CodeIgniter 3.0
 * @category        Library
 * @author          Xaverius Najoan
 * @license         MIT
 */

class Apicall {

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