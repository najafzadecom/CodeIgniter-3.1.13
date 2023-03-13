<?php

class Question_model extends CI_Model{

	protected  $table = 'questions';

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function get_count_all() {
		return $this->db->count_all($this->table);
	}

	public function get_questions($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);

		return $query->result();
	}

	public function get_all_questions() {
		$query = $this->db->get($this->table);

		return $query->result();
	}

	public function store()
	{
		$data = [
			'title'       => $this->input->post('title')
		];

		$result = $this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	public function get($id)
	{
		return $this->db->get_where($this->table, ['id' => $id ])->row();
	}

	public function update($id)
	{
		$data = [
			'title'        => $this->input->post('title')
		];

		return $this->db->where('id',$id)->update($this->table,$data);
	}

	public function delete($id)
	{
		return $this->db->delete($this->table, array('id' => $id));
	}

}
?>
