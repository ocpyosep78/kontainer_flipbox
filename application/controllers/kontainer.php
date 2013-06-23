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
		$data['rows'] = $this->kontainer->get_rows(0, 20);
		$data['perusahaan'] = $this->perusahaan->get_all_perusahaan();

		$this->load->view('kontainer_view', $data);
	}

	function page($pg)
	{
		$data['rows'] = $this->kontainer->get_rows(20*($pg-1), 20);
		$data['perusahaan'] = $this->perusahaan->get_all_perusahaan();

		$this->load->view('kontainer_view', $data);
	}

	function entry()
	{
		
		
		redirect('kontainer');
	}
}
