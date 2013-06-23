<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontainer_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM kontainer ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer ORDER BY no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert_data($data)
	{
		$this->db->insert('kontainer', $data);
	}
}
