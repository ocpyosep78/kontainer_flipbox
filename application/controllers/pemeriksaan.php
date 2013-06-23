<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaan extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('pemeriksaan_view.php');
	}
}
