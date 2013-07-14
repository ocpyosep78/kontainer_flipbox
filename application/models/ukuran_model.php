<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ukuran_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_ukuran()
	{
		$kueri = "SELECT ukuran FROM ukuran ORDER BY id";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}
}
