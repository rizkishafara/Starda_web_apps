<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Beranda';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();
		$this->load->view('template/header_view', $data);
		$this->load->view('template/nav_view', $data);
		$this->load->view('beranda_view');
		$this->load->view('template/footer_view');
	}
}
