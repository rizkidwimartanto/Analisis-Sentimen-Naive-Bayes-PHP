<?php
class Dataset_Model extends CI_Model
{
	var $dataset = 'dataset';
	public function getAllData()
	{
		return $this->db->get('dataset')->result();
	}
	public function tambah_data()
	{
		$data = array(
			'penulis' => $this->input->post('penulis', true),
			'komentar' => $this->input->post('komentar', true),
		);

		$this->db->insert('dataset', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'penulis' => $this->input->post('penulis', true),
			'komentar' => $this->input->post('komentar', true),
			'sentimen' => $this->input->post('sentimen', true),
		);
		$this->db->where('id', $this->input->post('id', true));
		$this->db->update('dataset', $data);
	}

	public function hapus_data($id)
	{
		$this->db->delete('dataset', ['id' => $id]);
	}

	public function detail_data($id)
	{
		return $this->db->get_where('dataset', ['id' => $id])->row_array();
	}
	function insert_transaction_batch($data)
	{
		$this->db->insert_batch($this->dataset, $data);
	}
	public function get_sentimen_positif()
	{
		$this->db->select('*');
		$this->db->from('dataset');
		$this->db->like('sentimen', 'positif');
		return $this->db->count_all_results();
	}
	public function get_sentimen_negatif()
	{
		$this->db->select('*');
		$this->db->from('dataset');
		$this->db->like('sentimen', 'negatif');
		return $this->db->count_all_results();
	}
	public function get_sentimen_netral()
	{
		$this->db->select('*');
		$this->db->from('dataset');
		$this->db->like('sentimen', 'netral');
		return $this->db->count_all_results();
	}
}
