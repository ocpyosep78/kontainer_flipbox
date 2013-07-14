<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemen_ukuran_pemeriksa extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pemeriksa_model', 'pemeriksa', true);
		$this->load->model('ukuran_model', 'ukuran', true);
	}

	function index()
	{
		$data['list_ukuran'] = $this->ukuran->get_all_ukuran();
		$data['list_pemeriksa'] = $this->pemeriksa->get_all_pemeriksa();

		$this->load->view('manajemen_ukuran_pemeriksa_view', $data);
	}

	function add_ukuran()
	{
		$data = $_POST;
		$this->ukuran->insert($data);
		redirect('manajemen_ukuran_pemeriksa');
	}

	function add_pemeriksa()
	{
		$data = $_POST;
		$this->pemeriksa->insert($data);
		redirect('manajemen_ukuran_pemeriksa');
	}

	function delete_ukuran($no)
	{
		$this->ukuran->delete($no);
		redirect('manajemen_ukuran_pemeriksa');
	}

	function delete_pemeriksa($no)
	{
		$this->pemeriksa->delete($no);
		redirect('manajemen_ukuran_pemeriksa');
	}
}



