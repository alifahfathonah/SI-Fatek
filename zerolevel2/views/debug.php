<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

echo "<pre>";
print_r($this->session->all_userdata());
echo "</pre>";

echo "<pre>";
print_r($this->session->flashdata());
echo "</pre>";

echo "<pre>";
print_r($this->_ci_cached_vars);
echo "</pre>";
?>