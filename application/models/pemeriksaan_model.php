<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM kontainer WHERE status = 1 ORDER BY tanggal,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer WHERE status = 1 ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_all_rows($key)
	{
		$tanggal = "tanggal like '%$key%' OR";
		if($key == '-') $tanggal = "";
		$kueri = "SELECT * FROM kontainer WHERE status = 1 AND (no like '%$key%' OR $tanggal perusahaan like '%$key%'
				OR kode like '%$key%' OR nomor like '%$key%' OR ukuran LIKE '%$key%')
				ORDER BY tanggal,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_rows($key, $start, $limit)
	{
		$tanggal = "tanggal like '%$key%' OR";
		if($key == '-') $tanggal = "";
		$kueri = "SELECT * FROM kontainer WHERE status = 1 AND (no like '%$key%' OR $tanggal perusahaan like '%$key%'
				OR kode like '%$key%' OR nomor like '%$key%' OR ukuran LIKE '%$key%')
				ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_row($no)
	{
		$kueri = "SELECT * FROM kontainer WHERE status = 1 AND no = $no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$tanggal = $data['tanggal'];
		$part = explode('/', $tanggal);
		$data['tanggal'] = $part[2].'-'.$part[0].'-'.$part[1];
		// echo $data['tanggal'];
		$this->db->insert('kontainer', $data);
	}

	function update($data)
	{
		$tanggal = $data['tanggal'];
		$part = explode('/', $tanggal);
		$data['tanggal'] = $part[2].'-'.$part[0].'-'.$part[1];
		$this->db->where('no', $data['no']);
		$ret = $this->db->update('kontainer', $data); 
		return $ret;
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

	function get_search_max_page($key)
	{
		$numrows = count($this->get_search_all_rows($key));
		return intval(($numrows-1)/30) + 1;
	}
}
