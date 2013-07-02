<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontainer extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('kontainer_model', 'kontainer', true);
		$this->load->model('perusahaan_model', 'perusahaan', true);
	}

	function index()
	{
		$data['rows'] = $this->kontainer->get_rows(0, 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->kontainer->get_max_page();
		$data['page'] = 1;

		$this->load->view('kontainer_view', $data);
	}

	function page($pg = null)
	{
		if(!isset($pg)) redirect('kontainer/page/1');

		$data['rows'] = $this->kontainer->get_rows(30*($pg-1), 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->kontainer->get_max_page();
		$data['page'] = $pg;

		if($pg > $data['maxpage']) redirect('kontainer/page/'.$data['maxpage']);

		$this->load->view('kontainer_view', $data);
	}

	function search()
	{
		$key;
		if(isset($_POST['search'])) $key = $_POST['search'];
		else $key = $_GET['key'];

		$pg = 1;
		if(isset($_GET['page'])) $pg = $_GET['page'];

		$data['key'] = $key;
		$data['rows'] = $this->kontainer->get_search_rows($key, 30*($pg-1), 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->kontainer->get_search_max_page($key);
		$data['page'] = $pg;

		if($pg > $data['maxpage']) redirect('kontainer/search?key='.$key."&page=".$data['maxpage']);

		$this->load->view('kontainer_view', $data);
	}

	function entry()
	{
		$data = $_POST;
		$fun = $data['fun'];
		unset($data['fun']);
		$this->kontainer->insert($data);

		redirect('kontainer/'.(($fun == "page") ? $fun : ("search?key=".$fun)));
	}

	function ip($no)
	{
		extract($_GET);
		$data['no'] = $no;
		$data['status'] = '1';
		if(isset($no_pib)) $data['no_pib'] = $no_pib;
		if(isset($tgl_pib)) $data['tgl_pib'] = $tgl_pib;
		if(isset($jam_ip)) $data['jam_ip'] = $jam_ip;
		if(isset($jam_periksa)) $data['jam_periksa'] = $jam_periksa;
		if(isset($uraian)) $data['uraian'] = $uraian;
		if(isset($pemeriksa)) $data['pemeriksa'] = $pemeriksa;

		$this->kontainer->update($data);

		if(isset($back_url)) redirect($back_url);
		redirect('kontainer');
	}

	function delete($no)
	{
		$this->kontainer->delete($no);

		if(isset($_GET['back_url'])){
			$back_url = urldecode($_GET['back_url']);
			redirect($back_url);
		}
		redirect('kontainer');
	}

	function update()
	{
		$data['no'] = $_POST['no'];
		$data['tanggal'] = $_POST['tanggal'];
		$data['perusahaan'] = $_POST['perusahaan'];
		$data['kode'] = $_POST['kode'];
		$data['nomor'] = $_POST['nomor'];
		$data['ukuran'] = $_POST['ukuran'];
		$ret = $this->kontainer->update($data);
	}
}



