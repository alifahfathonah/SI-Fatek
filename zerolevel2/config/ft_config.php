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
//define('URL_DOKUMEN',		"http://localhost/fatek.unsrat.ac.id/ft_data/dokumen/");
define('URL_FOTO_DOSEN',	"http://fatek.unsrat.ac.id/ft_data/fotodosen/");
//define('URL_FOTO_DOSEN',	"http://localhost/fatek.unsrat.ac.id/ft_data/fotodosen/");

define('URL_SINTA',			"http://sinta2.ristekdikti.go.id/authors/detail?id=");
define('URL_GOOGLE',		"https://scholar.google.co.id/citations?user=");
define('URL_SCOPUS',		"https://www.scopus.com/authid/detail.uri?authorId=");

define('DIR_FOTO_DOSEN',	"../ft_data/fotodosen/");
define('DIR_DOKUMEN',		"../ft_data/dokumen/");

define('URL_API',			"https://sitdev.unsrat.ac.id/tikdev/usr_api/");
//define('URL_API',			"http://localhost/unsrat-api/");
define('API_KEY',			"USR-API-KEY: b9QKaYcC0okSG9kkVa4PM6pw9S5BU7");

define('THEME_ADMIN',		"themes/AdminBSBMaterialDesign");
define('THEME_DOSEN',		"themes/AdminBSBMaterialDesign");
define('THEME_MHS',			"themes/AdminBSBMaterialDesign");

$config['pasfoto_dosen'] = array(
	'upload_path' 		=> DIR_FOTO_DOSEN,
	'allowed_types' 	=>'jpg|jpeg',
	'file_ext_tolower'	=> TRUE,
	'encrypt_name' 		=> TRUE,
);