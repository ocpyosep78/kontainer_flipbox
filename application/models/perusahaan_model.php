<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_perusahaan()
	{
		$kueri = "SELECT kode FROM perusahaan ORDER BY no";
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

	function get_xls_rows()
	{
		$kueri = "SELECT P.no,owner,count(*) as jml_kontainer
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan
				  GROUP BY owner ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		return $ret;
	}

	function get_jumlah_kontainer_ukuran($owner, $ukuran)
	{
		$kueri = "SELECT P.no,owner,count(*) as jml_peruk
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND owner='$owner'
				  GROUP BY owner ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['jml_peruk'];
	}

	function get_jumlah_kontainer_jml_lalu($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tanggal_masuk < '$tglx'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}

	function get_jumlah_kontainer_sisa_lalu($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tanggal_masuk < '$tglx' AND tgl_sppb = '0000-00-00'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}

	function get_jumlah_kontainer_masuk_hari_ini($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tanggal_masuk = '$tglx'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}

	function get_jumlah_kontainer_ip($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tgl_ip = '$tglx'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}

	function get_jumlah_kontainer_sppb($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tgl_sppb = '$tglx'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}

	function get_jumlah_kontainer_jumlah($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tanggal_masuk <= '$tglx'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}

	function get_jumlah_kontainer_sisa($kode, $ukuran, $tglx)
	{
		if(isset($tglx)){
			$tglx = str_replace("/", "-", $tglx);
		}
		$kueri = "SELECT P.no, P.kode, count(*) as ret
				  FROM perusahaan P INNER JOIN kontainer K ON P.kode = K.perusahaan WHERE ukuran='$ukuran' AND P.kode='$kode' AND tanggal_masuk <= '$tglx' AND tgl_sppb = '0000-00-00'
				  GROUP BY P.kode ORDER BY no";
		$ret = $this->db->query($kueri)->result_array();
		if(count($ret) == 0) return 0;
		return $ret[0]['ret'];
	}
}


