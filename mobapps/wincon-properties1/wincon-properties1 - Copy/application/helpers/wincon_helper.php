<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



 if ( ! function_exists('getVanderList'))
{
	function getVanderList(){
		$table = 'vendor_master';
		$anything->ci = &get_instance();
		$anything->ci->db->select('*');
		$vendor_master = $anything->ci->db->get($table)->result();
		
		return $vendor_master;
	}
}

?>