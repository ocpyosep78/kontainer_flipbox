<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM kontainer WHERE status >= 1 ORDER BY tanggal,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer WHERE status >= 1 ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_all_rows($key)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal = "tanggal like '%$keytanggal%' OR";
		$tanggal2 = "tanggal like '%$keytanggal%' OR";
		if($key == '-'){
			$tanggal = "";
			$tgl_pib = "";
		}

		$kueri = "SELECT * FROM kontainer WHERE status >= 1 AND (no LIKE '%$key%' OR $tanggal perusahaan LIKE '%$key%'
				OR kode LIKE '%$key%' OR nomor LIKE '%$key%' OR ukuran LIKE '%$key%' OR no_pib LIKE '%$key%' OR tgl_pib LIKE '%$tgl_pib%'
				OR jam_ip LIKE '%$key%' OR jam_periksa LIKE '%$key%' OR uraian LIKE '%$key%' OR pemeriksa LIKE '%$key%')
				ORDER BY tanggal,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_rows($key, $start, $limit)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal = "tanggal like '%$keytanggal%' OR";
		$tanggal2 = "tanggal like '%$keytanggal%' OR";
		if($key == '-'){
			$tanggal = "";
			$tgl_pib = "";
		}

		$kueri = "SELECT * FROM kontainer WHERE status >= 1 AND (no LIKE '%$key%' OR $tanggal perusahaan LIKE '%$key%'
				OR kode LIKE '%$key%' OR nomor LIKE '%$key%' OR ukuran LIKE '%$key%' OR no_pib LIKE '%$key%' OR tgl_pib LIKE '%$tgl_pib%'
				OR jam_ip LIKE '%$key%' OR jam_periksa LIKE '%$key%' OR uraian LIKE '%$key%' OR pemeriksa LIKE '%$key%')
				ORDER BY tanggal,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_row($no)
	{
		$kueri = "SELECT * FROM kontainer WHERE status >= 1 AND no = $no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$data['tanggal'] = str_replace("/", "-", $data['tanggal']);
		$data['tgl_pib'] = str_replace("/", "-", $data['tgl_pib']);
		
		$this->db->insert('kontainer', $data);
	}

	function sppb($no)
	{
		$data['status'] = '2';
		$this->db->where('no', $no);
		$this->db->update('kontainer', $data); 
	}

	function update($data)
	{
		if(isset($data['tanggal'])){
			$data['tanggal'] = str_replace("/", "-", $data['tanggal']);
		}
		if(isset($data['tgl_pib'])){
			$data['tgl_pib'] = str_replace("/", "-", $data['tgl_pib']);
		}

		$this->db->where('no', $data['no']);
		$ret = $this->db->update('kontainer', $data); 
		return $ret;
	}

	function delete($no)
	{
		$data['status'] = '0';
		$this->db->where('no', $no);
		$ret = $this->db->update('kontainer', $data); 
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
