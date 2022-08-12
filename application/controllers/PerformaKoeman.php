<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class PerformaKoeman extends CI_Controller
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
			'judul' => 'Performa Ronald Koeman',
            'sentimen_positif' => $this->Dataset_Model->get_sentimen_positif(),
			'sentimen_negatif' => $this->Dataset_Model->get_sentimen_negatif(),
			'sentimen_netral' => $this->Dataset_Model->get_sentimen_netral()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('performakoeman/index', $data);
		$this->load->view('templates/footer');
	}
}
