<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Question_model', 'question');
		$this->load->model('Answer_model', 'answer');
		$this->load->library('session');

	}

	public function index()
	{
		$data['questions'] = $this->question->get_all_questions();

		$this->load->view('index', $data);
	}

	public function calculate()
	{
		$total_point = 0;
		$answers = $this->input->post('answers');

		foreach ($answers as $key => $value) {
			if ($this->answer->check($key)) {
				$total_point += 1;
			}
		}

		$this->session->set_flashdata('success', "Duzgun cavab: " . $total_point);
		redirect(base_url('/'));
	}
}
