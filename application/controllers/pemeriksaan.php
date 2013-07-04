<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pemeriksaan_model', 'pemeriksaan', true);
		$this->load->model('perusahaan_model', 'perusahaan', true);
	}

	function index()
	{
		$data['rows'] = $this->pemeriksaan->get_rows(0, 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->pemeriksaan->get_max_page();
		$data['page'] = 1;

		$this->load->view('pemeriksaan_view', $data);
	}

	function page($pg = null)
	{
		if(!isset($pg)) redirect('pemeriksaan/page/1');

		$data['rows'] = $this->pemeriksaan->get_rows(30*($pg-1), 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->pemeriksaan->get_max_page();
		$data['page'] = $pg;

		if($pg > $data['maxpage']) redirect('pemeriksaan/page/'.$data['maxpage']);

		$this->load->view('pemeriksaan_view', $data);
	}

	function search()
	{
		$key;
		if(isset($_POST['search'])) $key = $_POST['search'];
		else $key = $_GET['key'];

		$pg = 1;
		if(isset($_GET['page'])) $pg = $_GET['page'];

		$data['key'] = $key;
		$data['rows'] = $this->pemeriksaan->get_search_rows($key, 30*($pg-1), 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->pemeriksaan->get_search_max_page($key);
		$data['page'] = $pg;

		if($pg > $data['maxpage']) redirect('pemeriksaan/search?key='.$key."&page=".$data['maxpage']);

		$this->load->view('pemeriksaan_view', $data);
	}

	function entry()
	{
		$data = $_POST;
		$fun = $data['fun'];
		unset($data['fun']);
		$data['status'] = '1';
		$this->pemeriksaan->insert($data);

		redirect('pemeriksaan/'.(($fun == "page") ? $fun : ("search?key=".$fun)));
	}

	function delete($no)
	{
		$this->pemeriksaan->delete($no);

		if(isset($_GET['back_url'])){
			$back_url = urldecode($_GET['back_url']);
			redirect($back_url);
		}
		redirect('pemeriksaan');
	}

	function update()
	{
		$data['no'] = $_POST['no'];
		$data['tanggal'] = $_POST['tanggal'];
		$data['perusahaan'] = $_POST['perusahaan'];
		$data['no_pib'] = $_POST['no_pib'];
		$data['tgl_pib'] = $_POST['tgl_pib'];
		$data['kode'] = $_POST['kode'];
		$data['nomor'] = $_POST['nomor'];
		$data['ukuran'] = $_POST['ukuran'];
		$data['jam_ip'] = $_POST['jam_ip'];
		$data['jam_periksa'] = $_POST['jam_periksa'];
		$data['uraian'] = $_POST['uraian'];
		$data['pemeriksa'] = $_POST['pemeriksa'];
		$ret = $this->pemeriksaan->update($data);
	}

	function sppb($no)
	{
		$this->pemeriksaan->sppb($no);

		if(isset($_GET['back_url'])){
			$back_url = urldecode($_GET['back_url']);
			redirect($back_url);
		}
		redirect('pemeriksaan');
	}

	function download_xls()
	{
		if(!isset($_GET['key'])){
			$data['filename'] = "pemeriksaan.xls";
			$data['headers'] = Array("No.", "Tanggal", "Perusahaan", "No. PIB", "Tgl PIB", "Kode Kontainer", "No. Kontainer", "Ukuran", "Jam IP", "Jam Periksa", "Uraian Barang", "Pemeriksa");	
			$data['row_keys'] = Array("no", "tanggal", "perusahaan", "no_pib", "tgl_pib", "kode", "nomor", "ukuran", "jam_ip", "jam_periksa", "uraian", "pemeriksa");
			$data['rows'] = $this->pemeriksaan->get_all_rows();
		}else{
			$key = $_GET['key'];
			$data['filename'] = "pemeriksaan_search=$key.xls";
			$data['headers'] = Array("No.", "Tanggal", "Perusahaan", "No. PIB", "Tgl PIB", "Kode Kontainer", "No. Kontainer", "Ukuran", "Jam IP", "Jam Periksa", "Uraian Barang", "Pemeriksa");	
			$data['row_keys'] = Array("no", "tanggal", "perusahaan", "no_pib", "tgl_pib", "kode", "nomor", "ukuran", "jam_ip", "jam_periksa", "uraian", "pemeriksa");
			$data['rows'] = $this->pemeriksaan->get_search_all_rows($key);
		}
		$this->load->view('download_xls', $data);
	}
}



