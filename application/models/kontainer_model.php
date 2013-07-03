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

	function get_search_all_rows($key)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal = "tanggal like '%$keytanggal%' OR";
		if($key == '-') $tanggal = "";
		$kueri = "SELECT * FROM kontainer WHERE no like '%$key%' OR $tanggal perusahaan like '%$key%'
				OR kode like '%$key%' OR nomor like '%$key%' OR ukuran LIKE '%$key%'
				ORDER BY tanggal,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_rows($key, $start, $limit)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal = "tanggal like '%$keytanggal%' OR";
		if($key == '-') $tanggal = "";
		$kueri = "SELECT * FROM kontainer WHERE no like '%$key%' OR $tanggal perusahaan like '%$key%'
				OR kode like '%$key%' OR nomor like '%$key%' OR ukuran LIKE '%$key%'
				ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_row($no)
	{
		$kueri = "SELECT * FROM kontainer WHERE no = $no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$data['tanggal'] = str_replace("/", "-", $data['tanggal']);

		if(isset($data['tgl_pib'])){
			$part = explode('/', $tgl_pib);
			$data['tgl_pib'] = $part[2].'-'.$part[0].'-'.$part[1];
		}
		
		$this->db->insert('kontainer', $data);
	}

	function update($data)
	{
		if(isset($data['tanggal'])){
			$data['tanggal'] = str_replace("/", "-", $data['tanggal']);
		}
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
