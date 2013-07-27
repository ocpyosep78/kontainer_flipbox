<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontainer_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM kontainer ORDER BY tanggal_masuk,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_all_rows($key)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal_masuk = "tanggal_masuk like '%$keytanggal%' OR";
		if($key == '-') $tanggal_masuk= "";
		$kueri = "SELECT * FROM kontainer WHERE no like '%$key%' OR $tanggal_masuk perusahaan like '%$key%'
				OR kode like '%$key%' OR nomor like '%$key%' OR ukuran LIKE '%$key%'
				ORDER BY tanggal_masuk,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer ORDER BY tanggal_masuk,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_rows($key, $start, $limit)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal_masuk = "tanggal_masuk like '%$keytanggal%' OR";
		if($key == '-') $tanggal_masuk= "";
		$kueri = "SELECT * FROM kontainer WHERE no like '%$key%' OR $tanggal_masuk perusahaan like '%$key%'
				OR kode like '%$key%' OR nomor like '%$key%' OR ukuran LIKE '%$key%'
				ORDER BY tanggal_masuk,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_row($no)
	{
		$kueri = "SELECT * FROM kontainer WHERE id = $no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function insert($data)
	{
		$data['tanggal_masuk'] = str_replace("/", "-", $data['tanggal_masuk']);
		
		$this->db->insert('kontainer', $data);
	}

	function update($data)
	{
		if(isset($data['tanggal_masuk'])){
			$data['tanggal_masuk'] = str_replace("/", "-", $data['tanggal_masuk']);
		}
		if(isset($data['tanggal_bap'])){
			$data['tanggal_bap'] = str_replace("/", "-", $data['tanggal_bap']);
		}
		if(isset($data['tgl_pib'])){
			$data['tgl_pib'] = str_replace("/", "-", $data['tgl_pib']);
		}
		if(isset($data['tgl_sppb'])){
			$data['tgl_sppb'] = str_replace("/", "-", $data['tgl_sppb']);
		}
		$this->db->where('id', $data['id']);
		$ret = $this->db->update('kontainer', $data); 
		return $ret;
	}

	function delete($no)
	{
		$kueri = "DELETE FROM kontainer WHERE id = $no";
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

	function get_xls_rows($tanggal_masuk = "", $perusahaan = "")
	{
		$this->db->select("no,tanggal_masuk,perusahaan,kode,nomor,ukuran,uraian,tgl_ip,tgl_sppb");
		$this->db->from("kontainer");
		if($tanggal_masuk) $this->db->where("tanggal_masuk", $tanggal_masuk);
		if($perusahaan) $this->db->where("perusahaan", $perusahaan);
		$this->db->order_by("tanggal_masuk,no", "asc");
		$ret = $this->db->get()->result_array();
		return $ret;
	}
}
