<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_perusahaan()
	{
		$kueri = "SELECT nama FROM perusahaan";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}
}
