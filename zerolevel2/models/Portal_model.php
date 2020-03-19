<?php
class Portal_model extends CI_Model {
		
	public function check_userpass_portal($user,$pass) {
	
		$link = mysqli_connect("103.84.116.110","usr_webfatek","SAMratu_langi8526","akademika_portal","3306");
		
		//$link = mysqli_connect("localhost","root","","portal","3306");
		
		//$result = mysqli_query($link, "SELECT tusrNama, tusrProfil, tusrPassword FROM t_user WHERE tusrNama='$user' AND tusrPassword=md5('$pass')");

		$result = mysqli_query($link, "SELECT tusrNama, tusrProfil, tusrPassword FROM t_user_ft WHERE tusrNama='$user' AND tusrPassword=SHA2(MD5('$pass'),512)");

		mysqli_close($link);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
	public function get_detail($user) {
	
		$link = mysqli_connect("103.84.116.110","usr_webfatek","SAMratu_langi8526","akademika_portal","3306");
		
		//$link = mysqli_connect("localhost","root","","portal","3306");
		
		//$result = mysqli_query($link, "SELECT tusrNama, tusrProfil, tusrPassword FROM t_user WHERE tusrNama='$user'");

		$result = mysqli_query($link, "SELECT tusrNama, tusrProfil, tusrPassword FROM t_user_ft WHERE tusrNama='$user'");

		mysqli_close($link);
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	
}