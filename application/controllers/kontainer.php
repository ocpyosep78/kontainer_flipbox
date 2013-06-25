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

	function page($pg)
	{
		$data['rows'] = $this->kontainer->get_rows(30*($pg-1), 30);
		$data['list_perusahaan'] = $this->perusahaan->get_all_perusahaan();
		$data['maxpage'] = $this->kontainer->get_max_page();
		$data['page'] = $pg;

		$this->load->view('kontainer_view', $data);
	}

	function entry()
	{
		$data = $_POST;
		$this->kontainer->insert($data);

		redirect('kontainer');
	}

	function delete($no)
	{
		$this->kontainer->delete($no);

		redirect('kontainer');
	}
}
