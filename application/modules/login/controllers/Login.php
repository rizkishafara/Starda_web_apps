<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');


		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('template/header_view', $data);
			$this->load->view('loginv');
		} else {
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user_data', ['email' => $email])->row();


		if ($user) {
			// $pass = $this->db->get_where('user_data', ['password' => md5($password)])->row_array();
			$pass = $user->password;
			
			if ($pass == md5($password)) {
				$data = $this->db->query('SELECT * FROM user_data WHERE email="' . $email . '"')->row();
				$id_user = $data->id_user;
				$status = $data->status;
				if ($status == 'active') {
					$this->session->set_userdata('id_user', $id_user);
					redirect('member');
				} else if ($status == 'non active') {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun anda belum aktif, silahkan hubungi admin</div>');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password anda salah!</div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email anda salah!</div>');
			redirect('login');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda berhasil logout</div>');
		redirect('beranda');
	}
}
