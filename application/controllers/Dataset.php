<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Dataset extends CI_Controller
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
			'judul' => 'Dataset',
			'training' => $this->Dataset_Model->getAllData()
		];

		$this->load->view('templates/header', $data);
		$this->load->view('dataset/index', $data);
		$this->load->view('templates/footer');
	}

	public function validation_form()
	{
		$this->form_validation->set_rules("penulis", "Penulis ", "required");
		$this->form_validation->set_rules("komentar", "Komentar ", "required");

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Dataset_Model->tambah_data();
			$this->session->set_flashdata('flash_training', 'Disimpan');
			redirect('Dataset');
		}
	}

	public function hapus($id)
	{
		$this->Dataset_Model->hapus_data($id);
		$this->session->set_flashdata('flash_training', 'Dihapus');
		redirect('Dataset');
	}

	public function ubah($id)
	{
		$this->form_validation->set_rules("penulis", "Penulis", "required");
		$this->form_validation->set_rules("komentar", "Komentar", "required");

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Data Training',
				'ubah' => $this->Dataset_Model->detail_data($id)
			];
			$this->load->view('templates/header', $data);
			$this->load->view('dataset/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Dataset_Model->ubah_data();
			$this->session->set_flashdata('flash_training', 'Diubah');
			redirect('Dataset');
		}
	}
	function import_excel()
	{
		$this->load->helper('file');

		/* Allowed MIME(s) File */
		$file_mimes = array(
			'application/octet-stream',
			'application/vnd.ms-excel',
			'application/x-csv',
			'text/x-csv',
			'text/csv',
			'application/csv',
			'application/excel',
			'application/vnd.msexcel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
		);

		if (isset($_FILES['uploadFile']['name']) && in_array($_FILES['uploadFile']['type'], $file_mimes) && $_FILES["upload_file"]['size'] < 5000) {

			$array_file = explode('.', $_FILES['uploadFile']['name']);
			$extension  = end($array_file);

			if ('csv' == $extension) {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
			$sheet_data  = $spreadsheet->getActiveSheet(0)->toArray();
			$array_data  = [];

			for ($i = 1; $i < count($sheet_data); $i++) {
				$data = array(
					'id'       => $sheet_data[$i]['0'],
					'penulis'      => $sheet_data[$i]['1'],
					'komentar'        => $sheet_data[$i]['2'],
				);
				$array_data[] = $data;
			}
			if ($array_data != '') {
				$this->Dataset_Model->insert_transaction_batch($array_data);
				$this->session->set_flashdata('flash_training', 'Diimport');
			}
		}
		redirect('Dataset');
	}
	public function hapusSemuaData()
	{
		$this->db->empty_table('dataset');
		$this->session->set_flashdata('flash_training', 'Dihapus');

		redirect('Dataset');
	}
}
