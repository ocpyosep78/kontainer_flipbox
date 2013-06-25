<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontainer_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM kontainer ORDER BY tanggal,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$tanggal = $data['tanggal'];
		$part = explode('/', $tanggal);
		$data['tanggal'] = $part[2].'-'.$part[0].'-'.$part[1];
		echo $data['tanggal'];
		$this->db->insert('kontainer', $data);
	}

	function delete($no)
	{
		$kueri = "DELETE FROM kontainer WHERE no = $no";
		$this->db->query($kueri);
	}

	function get_max_page()
	{
		$numrows = count($this->get_all_rows());
		return intval(($numrows-1)/30) + 1;
	}
}
