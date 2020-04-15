<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| FT Data Constant and Configuration
|--------------------------------------------------------------------------
|
| Created by Xaverius Najoan
|
*/

/* ----- Constant and configuration in localhost environment for testing purpose */
define('URL_DOKUMEN',		"http://localhost/fatek.unsrat.ac.id/ft_data/dokumen/test/");
define('URL_DOKUMEN_TMP',	"http://localhost/fatek.unsrat.ac.id/ft_data/dokumen/test/tmp/");
define('URL_FOTO',			"http://localhost/fatek.unsrat.ac.id/ft_data/foto/");
define('URL_API',			"http://localhost/unsrat-api/");
define('DIR_DOKUMEN',		"../ft_data/dokumen/test/");
define('DIR_DOKUMEN_TMP',	"../ft_data/dokumen/test/tmp/");
/* ----- End Of Constant and configuration in localhost environment for testing purpose */

/* ----- Constant and configuration in live-server environment */
//define('URL_DOKUMEN',		"https://fatek.unsrat.ac.id/ft_data/dokumen/");
//define('URL_DOKUMEN_TMP',	"https://fatek.unsrat.ac.id/ft_data/dokumen/tmp/");
//define('URL_FOTO',		"https://fatek.unsrat.ac.id/ft_data/foto/");
//define('URL_API',			"https://sitdev.unsrat.ac.id/tikdev/usr_api/");
//define('DIR_DOKUMEN',		"../ft_data/dokumen/");
//define('DIR_DOKUMEN_TMP',	"../ft_data/dokumen/tmp/");
/* ----- End Of Constant and configuration in live-server environment */

/* ----- Constant and configuration in all environment */
define('URL_SINTA',			"http://sinta2.ristekdikti.go.id/authors/detail?id=");
define('URL_GOOGLE',		"https://scholar.google.co.id/citations?user=");
define('URL_SCOPUS',		"https://www.scopus.com/authid/detail.uri?authorId=");
define('DIR_FOTO',			"../ft_data/foto/");
define('API_KEY',			"USR-API-KEY: b9QKaYcC0okSG9kkVa4PM6pw9S5BU7");
define('THEME',				"themes/AdminBSBMaterialDesign");

$config['pasfoto_dosen'] = array(
	'upload_path' 		=> DIR_FOTO . "dsn/",
	'allowed_types' 	=>'jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
);

$config['pasfoto_pgw'] = array(
	'upload_path' 		=> DIR_FOTO . "pgw/",
	'allowed_types' 	=>'jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
);

$config['dokumen_admin'] = array(
	'upload_path' 		=> DIR_DOKUMEN,
	'allowed_types' 	=>'pdf|jpg|jpeg|xls|xlsx|mde|doc|docx',
	'max_filename' 		=>'40',
	'file_ext_tolower'	=> TRUE,
	'max_size' 			=> '20000',
);

$config['dokumen'] = array(
	'upload_path' 		=> DIR_DOKUMEN,
	'allowed_types' 	=>'pdf|jpg|jpeg',
	'max_filename' 		=>'40',
	'file_ext_tolower'	=> TRUE,
	'max_size' 			=> '5000',
);

$config['dokumen_tmp'] = array(
	'upload_path' 		=> DIR_DOKUMEN_TMP,
	'allowed_types' 	=>'pdf|jpg|jpeg',
	'max_filename' 		=>'40',
	'file_ext_tolower'	=> TRUE,
	'max_size' 			=> '3000',
);

$config['status'] = array(
	'proposal0'			=> 'Ditolak ',
	'proposal1'			=> 'Diajukan mahasiswa - Menunggu persetujuan WD1',
	'proposal2'			=> 'Disetujui WD1 - Diteruskan ke Jurusan',
	'proposal3'			=> 'Disetujui Kajur - Diteruskan ke Prodi',
);
/* ----- End of Constant and configuration in all environment */