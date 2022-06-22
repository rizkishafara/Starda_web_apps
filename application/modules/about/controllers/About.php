<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'About';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$this->load->view('template/header_view', $data);
		$this->load->view('template/nav_view', $data);
		$this->load->view('about_view');
		$this->load->view('template/footer_view');
	}
}
