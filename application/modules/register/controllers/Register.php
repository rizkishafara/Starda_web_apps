<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('fullname', 'FullName', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user_data.email]', ['is_unique' => 'Email has been used.']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match',
			'min_length' => 'Password to short'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Register';
			$this->load->view('template/header_view', $data);
			$this->load->view('registerv');
		} else {
			$data = [
				'fullname' => htmlspecialchars($this->input->post('fullname', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => md5($this->input->post('password')),
				'photo_user' => 'default.png'

			];

			$this->db->insert('user_data', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Register!, silahkan Login</div>');
			redirect('login');
		}
	}
}
