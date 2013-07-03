<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_perusahaan()
	{
		$kueri = "SELECT nama FROM perusahaan ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM perusahaan ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_all_rows($key)
	{
		$kueri = "SELECT * FROM perusahaan WHERE nama LIKE '%$key%'
				OR owner LIKE '%$key%' OR kode LIKE '%$key%' ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM perusahaan ORDER BY no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_rows($key, $start, $limit)
	{
		$kueri = "SELECT * FROM perusahaan WHERE nama LIKE '%$key%'
				OR owner LIKE '%$key%' OR kode LIKE '%$key%' ORDER BY no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_row($no)
	{
		$kueri = "SELECT * FROM perusahaan WHERE no = $no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$this->db->insert('perusahaan', $data);
	}

	function update($data)
	{
		$this->db->where('no', $data['no']);
		$this->db->update('perusahaan', $data); 
	}

	function delete($no)
	{
		$kueri = "DELETE FROM perusahaan WHERE no = $no";
		$this->db->query($kueri);
	}

	function get_max_page()
	{
		$numrows = count($this->get_all_rows());
		return intval(($numrows-1)/30) + 1;
	}

	function get_search_max_page($key)
	{
		$numrows = count($this->get_search_all_rows($key));
		return intval(($numrows-1)/30) + 1;
	}
}
