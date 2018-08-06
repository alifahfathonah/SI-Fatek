<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| FT Data Configuration
|--------------------------------------------------------------------------
|
| Created by Xaverius Najoan
|
*/


define('LOC_FOTO_DOSEN',		"http://fatek.unsrat.ac.id/ft_data/fotodosen/");
define('LOC_FOTO_MAHASISWA',	"http://fatek.unsrat.ac.id/ft_data/fotomahasiswa/");
define('LOC_DOKUMEN_DOSEN',		"http://fatek.unsrat.ac.id/ft_data/dokumen/");

define('DIR_FOTO_DOSEN',	'../ft_data/fotodosen/');
define('DIR_FOTO_MAHASISWA','../ft_data/fotomahasiswa/');
define('DIR_DOKUMEN_DOSEN',	'../ft_data/dokumen/');


$config['pasfoto_mahasiswa'] = array(
	'upload_path' 		=> DIR_FOTO_MAHASISWA,
	'allowed_types' 	=>'jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
	'encrypt_name' 		=> TRUE,
);

$config['pasfoto_dosen'] = array(
	'upload_path' 		=> DIR_FOTO_DOSEN,
	'allowed_types' 	=>'jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
	'encrypt_name' 		=> TRUE,
);

$config['dokumen_dosen'] = array(
	'upload_path' 		=> DIR_DOKUMEN_DOSEN,
	'allowed_types' 	=>'pdf|jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
	'encrypt_name' 		=> TRUE,
	'max_size' 			=> '5000',
);