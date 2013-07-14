<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ukuran_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_ukuran()
	{
		$kueri = "SELECT * FROM ukuran ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$this->db->insert('ukuran', $data);
	}

	function delete($no)
	{
		$kueri = "DELETE FROM ukuran WHERE no = $no";
		$this->db->query($kueri);
	}
}
