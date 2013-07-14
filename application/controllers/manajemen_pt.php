<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemen_pt extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('perusahaan_model', 'perusahaan', true);
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
		$data['filename'] = "3. Rekap Daftar Perusahaan.xls";
		$data['row_keys'] = Array("no", "owner", "nama", "kode", "jml_kontainer");
		$data['rows'] = $this->perusahaan->get_xls_rows();
		
		$this->load->view('download_xls', $data);
	}
}



