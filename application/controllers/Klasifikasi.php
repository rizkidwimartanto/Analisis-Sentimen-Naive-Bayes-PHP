<?php 

/**
 * 
 */
class Klasifikasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Dataset_Model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = [
			'judul' => 'Klasifikasi',
			'training' => $this->Dataset_Model->getAllData()
		];
		$this->load->view('templates/header', $data);
		$this->load->view('klasifikasi/index', $data);
		$this->load->view('templates/footer');
	}
}
