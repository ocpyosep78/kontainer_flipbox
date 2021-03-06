<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemen_pt extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('perusahaan_model', 'perusahaan', true);
		$this->load->model('ukuran_model', 'ukuran', true);
	}

	function index()
	{
		$data['rows'] = $this->perusahaan->get_rows(0, 30);
		$data['maxpage'] = $this->perusahaan->get_max_page();
		$data['page'] = 1;

		$this->load->view('manajemen_pt_view', $data);
	}

	function page($pg = null)
	{
		if(!isset($pg)) redirect('manajemen_pt/page/1');

		$data['rows'] = $this->perusahaan->get_rows(30*($pg-1), 30);
		$data['maxpage'] = $this->perusahaan->get_max_page();
		$data['page'] = $pg;

		if($pg > $data['maxpage']) redirect('manajemen_pt/page/'.$data['maxpage']);

		$this->load->view('manajemen_pt_view', $data);
	}

	function search()
	{
		$key;
		if(isset($_POST['search'])) $key = $_POST['search'];
		else $key = $_GET['key'];

		$pg = 1;
		if(isset($_GET['page'])) $pg = $_GET['page'];

		$data['key'] = $key;
		$data['rows'] = $this->perusahaan->get_search_rows($key, 30*($pg-1), 30);
		$data['maxpage'] = $this->perusahaan->get_search_max_page($key);
		$data['page'] = $pg;

		if($pg > $data['maxpage']) redirect('manajemen_pt/search?key='.$key."&page=".$data['maxpage']);

		$this->load->view('manajemen_pt_view', $data);
	}

	function entry()
	{
		$data = $_POST;
		$fun = $data['fun'];
		unset($data['fun']);
		$this->perusahaan->insert($data);

		redirect('manajemen_pt/'.(($fun == "page") ? $fun : ("search?key=".$fun)));
	}

	function delete($no)
	{
		$this->perusahaan->delete($no);

		if(isset($_GET['back_url'])){
			$back_url = urldecode($_GET['back_url']);
			redirect($back_url);
		}
		redirect('manajemen_pt');
	}

	function update()
	{
		$data['no'] = $_POST['no'];
		$data['nama'] = $_POST['nama'];
		$data['owner'] = $_POST['owner'];
		$data['kode'] = $_POST['kode'];
		$ret = $this->perusahaan->update($data);
	}

	function download_xls()
	{
		$data['flag'] = 3;
		$data['filename'] = "Rekap Owner Perusahaan & Jumlah Kontainer.xls";
		$data['rows'] = $this->perusahaan->get_xls_rows();
		$data['list_ukuran'] = $this->ukuran->get_all_ukuran();
		$data['kontainer_per_ukuran'] = $this->get_kontainer_per_ukuran($data['rows'], $data['list_ukuran']);
		
		$this->load->view('download_xls', $data);
	}

	function get_kontainer_per_ukuran($rows, $list_ukuran)
	{
		$ret;
		foreach($rows as $row){
			$owner = $row['owner'];
			foreach($list_ukuran as $ukuran){
				$ukuran = $ukuran['ukuran'];
				$ret[$owner][$ukuran] = $this->perusahaan->get_jumlah_kontainer_ukuran($owner,$ukuran);
			}
		}
		return $ret;
	}

	function download_xls3()
	{
		$tglx = $this->input->get("tglx");
		if(!$tglx) $tglx = date("Y-m-d");

		$data['filename'] = "Rekapitulasi Kontainer.xls";
		$data['rows'] = $this->perusahaan->get_all_rows();
		$data['list_ukuran'] = $this->ukuran->get_all_ukuran();
		$data['rekap'] = $this->get_kontainer_per_ukuran2($data['rows'], $data['list_ukuran'], $tglx);
		$data['tglx'] = $tglx;
		
		$this->load->view('download_xls3', $data);
	}

	function get_kontainer_per_ukuran2($rows, $list_ukuran, $tglx)
	{
		$ret;
		foreach($rows as $row){
			$kode = $row['kode'];
			foreach($list_ukuran as $ukuran){
				$ukuran = $ukuran['ukuran'];
				$ret[$kode][$ukuran]['jml_lalu'] = $this->perusahaan->get_jumlah_kontainer_jml_lalu($kode, $ukuran, $tglx);
				$ret[$kode][$ukuran]['sisa_lalu'] = $this->perusahaan->get_jumlah_kontainer_sisa_lalu($kode, $ukuran, $tglx);
				$ret[$kode][$ukuran]['masuk_hari_ini'] = $this->perusahaan->get_jumlah_kontainer_masuk_hari_ini($kode, $ukuran, $tglx);
				$ret[$kode][$ukuran]['ip'] = $this->perusahaan->get_jumlah_kontainer_ip($kode, $ukuran, $tglx);
				$ret[$kode][$ukuran]['sppb'] = $this->perusahaan->get_jumlah_kontainer_sppb($kode, $ukuran, $tglx);
				$ret[$kode][$ukuran]['sisa'] = $this->perusahaan->get_jumlah_kontainer_sisa($kode, $ukuran, $tglx);
				$ret[$kode][$ukuran]['jumlah'] = $this->perusahaan->get_jumlah_kontainer_jumlah($kode, $ukuran, $tglx);
			}
		}
		return $ret;
	}
}



