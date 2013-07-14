<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksa_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_pemeriksa()
	{
		$kueri = "SELECT nama FROM pemeriksa ORDER BY id";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}
}
