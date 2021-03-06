<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_rows()
	{
		$kueri = "SELECT * FROM kontainer WHERE status >= 1 ORDER BY tanggal_bap,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_rows($start, $limit)
	{
		$kueri = "SELECT * FROM kontainer WHERE status >= 1 ORDER BY tanggal_bap,no LIMIT $start, $limit";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_all_rows($key)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal_bap = "OR tanggal_bap like '%$keytanggal%'";
		$tgl_pib = "OR tgl_pib like '%$keytanggal%'";
		$tgl_sppb = "OR tgl_sppb like '%$keytanggal%'";
		if($key == '-'){
			$tanggal_bap = "";
			$tgl_pib = "";
			$tgl_sppb = "";
		}

		$kueri = "SELECT * FROM kontainer WHERE status >= 1 AND (no LIKE '%$key%' OR no_bap LIKE '%$key%' $tanggal_bap OR perusahaan LIKE '%$key%'
				OR kode LIKE '%$key%' OR nomor LIKE '%$key%' OR ukuran LIKE '%$key%' OR no_pib LIKE '%$key%' $tgl_pib
				OR jam_ip LIKE '%$key%' OR jam_periksa_st LIKE '%$key%' OR jam_periksa_en LIKE '%$key%' OR uraian LIKE '%$key%' OR pemeriksa LIKE '%$key%' $tgl_sppb)
				ORDER BY tanggal_bap,no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_search_rows($key, $start, $limit)
	{
		$keytanggal = str_replace("/", "-", $key);
		$tanggal_bap = "OR tanggal_bap like '%$keytanggal%'";
		$tgl_pib = "OR tgl_pib like '%$keytanggal%'";
		$tgl_sppb = "OR tgl_sppb like '%$keytanggal%'";
		if($key == '-'){
			$tanggal_bap = "";
			$tgl_pib = "";
			$tgl_sppb = "";
		}

		$kueri = "SELECT * FROM kontainer WHERE status >= 1 AND (no LIKE '%$key%' OR no_bap LIKE '%$key%' $tanggal_bap OR perusahaan LIKE '%$key%'
				OR kode LIKE '%$key%' OR nomor LIKE '%$key%' OR ukuran LIKE '%$key%' OR no_pib LIKE '%$key%' $tgl_pib
				OR jam_ip LIKE '%$key%' OR jam_periksa_st LIKE '%$key%' OR jam_periksa_en LIKE '%$key%' OR uraian LIKE '%$key%' OR pemeriksa LIKE '%$key%' $tgl_sppb)
				ORDER BY tanggal_bap,no LIMIT $start, $limit";
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
		$data['tanggal_bap'] = str_replace("/", "-", $data['tanggal_bap']);
		$data['tgl_pib'] = str_replace("/", "-", $data['tgl_pib']);
		$data['tgl_sppb'] = str_replace("/", "-", $data['tgl_sppb']);
		
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
		if(isset($data['tanggal_bap'])){
			$data['tanggal_bap'] = str_replace("/", "-", $data['tanggal_bap']);
		}
		if(isset($data['tgl_pib'])){
			$data['tgl_pib'] = str_replace("/", "-", $data['tgl_pib']);
		}
		if(isset($data['tgl_sppb'])){
			$data['tgl_sppb'] = str_replace("/", "-", $data['tgl_sppb']);
		}

		$this->db->where('no', $data['no']);
		$ret = $this->db->update('kontainer', $data); 
		return $ret;
	}

	function delete($no)
	{
		$data['status'] = '0';
		$data['no_bap'] = NULL;
		$data['tanggal_bap'] = NULL;
		$data['no_pib'] = NULL;
		$data['tgl_pib'] = NULL;
		$data['jam_ip'] = NULL;
		$data['jam_periksa_st'] = NULL;
		$data['jam_periksa_en'] = NULL;
		$data['uraian'] = NULL;
		$data['pemeriksa'] = NULL;
		$data['tgl_sppb'] = NULL;
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

	function get_xls_rows($tanggal_bap = "", $tgl_sppb = "", $perusahaan = "", $pemeriksa = "")
	{
		$this->db->select("no,no_bap,tanggal_bap,perusahaan,no_pib,tgl_pib,kode,nomor,ukuran,jam_ip,jam_periksa_st,jam_periksa_en,uraian,pemeriksa,tgl_sppb");
		$this->db->from("kontainer");
		$this->db->where("status >=", 1);
		if($tanggal_bap) $this->db->where("tanggal_bap", $tanggal_bap);
		if($tgl_sppb) $this->db->where("tgl_sppb", $tgl_sppb);
		if($perusahaan) $this->db->where("perusahaan", $perusahaan);
		if($pemeriksa) $this->db->where("pemeriksa", $pemeriksa);
		$this->db->order_by("tanggal_bap,no", "asc");
		$ret = $this->db->get()->result_array();
		return $ret;
	}

	function get_xls_rows2($tanggal_masuk = "", $tanggal_bap = "", $tgl_sppb = "", $perusahaan = "", $pemeriksa = "")
	{
		$this->db->where("status >=", 1);
		if($tanggal_masuk) $this->db->where("tanggal_masuk", $tanggal_masuk);
		if($tanggal_bap) $this->db->where("tanggal_bap", $tanggal_bap);
		if($tgl_sppb) $this->db->where("tgl_sppb", $tgl_sppb);
		if($perusahaan) $this->db->where("perusahaan", $perusahaan);
		if($pemeriksa) $this->db->where("pemeriksa", $pemeriksa);
		$this->db->order_by("tanggal_bap,no", "asc");
		$ret = $this->db->get("kontainer")->result_array();
		return $ret;
	}
}


