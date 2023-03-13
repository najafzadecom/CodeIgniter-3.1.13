<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Question extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library("pagination");
		$this->load->model('Question_model', 'question');
		$this->load->model('Answer_model', 'answer');

	}

	public function index()
	{

		$data['title'] = "Questions";
		$config["base_url"] = base_url() . "question";
		$config["total_rows"] = $this->question->get_count_all();
		$config["per_page"] = 10;
		$config["uri_segment"] = 2;
		/*
		  start
		  add boostrap class and styles
		*/
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		/*
		  end
		  add boostrap class and styles
		*/
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data["links"] = $this->pagination->create_links();
		$data['questions'] = $this->question->get_questions($config["per_page"], $page);
		$this->load->view('admin/index',$data);

	}

	public function create()
	{
		$data['title'] = "Create Question";
		$this->load->view('admin/create', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');

		if (!$this->form_validation->run())
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect(base_url('question/create'));
		}
		else
		{
			$question_id = $this->question->store();
			$this->answer->store($this->input->post('answers'), $question_id);
			$this->session->set_flashdata('success', "Saved Successfully!");
			redirect(base_url('question'));
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Question";
		$data['question'] = $this->question->get($id);
		$data['answers'] = $this->answer->get($id);
		$this->load->view('admin/edit', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'required');

		if (!$this->form_validation->run())
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect(base_url('question/edit/' . $id));
		}
		else
		{
			$this->question->update($id);
			$this->answer->delete($id);
			$this->answer->store($this->input->post('answers'), $id);

			$this->session->set_flashdata('success', "Updated Successfully!");
			redirect(base_url('question'));
		}
	}

	public function delete($id)
	{
		$this->question->delete($id);
		$this->answer->delete($id);
		$this->session->set_flashdata('success', "Deleted Successfully!");
		redirect(base_url('question'));
	}
}
