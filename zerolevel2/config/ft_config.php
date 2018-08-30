<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| FT Data Constant and Configuration
|--------------------------------------------------------------------------
|
| Created by Xaverius Najoan
|
*/

define('URL_DOKUMEN',		"http://fatek.unsrat.ac.id/ft_data/dokumen/");
define('URL_API',			"https://sitdev.unsrat.ac.id/tikdev/usr_api/");
//define('URL_API',			"http://localhost/unsrat-api/");
define('URL_FOTO_MHS',		"https://kkt.unsrat.ac.id/images/user_foto/");
define('DIR_DOKUMEN',		"../ft_data/dokumen/");
define('DIR_PROPOSAL',		"files/proposal/");

$config['proposal'] = array(
	'upload_path' 		=> DIR_PROPOSAL,
	'allowed_types' 	=>'pdf|jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
	'max_size' 			=> '5000',
);