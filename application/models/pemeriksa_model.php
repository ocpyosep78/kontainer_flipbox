<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksa_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_pemeriksa()
	{
		$kueri = "SELECT * FROM pemeriksa ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$this->db->insert('pemeriksa', $data);
	}

	function delete($no)
	{
		$kueri = "DELETE FROM pemeriksa WHERE no = $no";
		$this->db->query($kueri);
	}
}
