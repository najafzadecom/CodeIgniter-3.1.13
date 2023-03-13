<?php

class Answer_model extends CI_Model{

	protected  $table = 'answers';

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	public function store($answers, $question_id)
	{
		foreach($answers as $answer) {
			$data[] = [
				'question_id' => $question_id,
				'title'       => $answer['title'],
				'correct'     => $answer['correct'] ? 1 : 0,
			];
		}

		return $this->db->insert_batch($this->table, $data);
	}

	public function get($question_id)
	{
		return $this->db->get_where($this->table, ['question_id' => $question_id ])->result();
	}

	public function check($answer_id)
	{
		return $this->db->get_where($this->table, ['id' => $answer_id, 'correct' => 1])->row();
	}


	public function delete($question_id)
	{
		return $this->db->delete($this->table, array('question_id' => $question_id));
	}
}
?>
