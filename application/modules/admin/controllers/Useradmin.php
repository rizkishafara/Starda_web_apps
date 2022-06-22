<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Useradmin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_login();
		$this->load->model('m_useradmin');
	}
	public function index()
	{
		$data['title'] = 'Useradmin';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['useradmin'] = $this->m_useradmin->useradmin()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('useradmin/useradmin_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function add_admin()
	{
		$this->m_useradmin->addAdmin();
		redirect('admin/Useradmin');
	}
	public function edit_admin($id)
	{
		$this->m_useradmin->editAdmin($id);
		redirect('admin/Useradmin');
	}
	public function delete_admin($id){
		$this->db->where('id_admin', $id);
        $this->db->delete('admin');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Useradmin');
	}
	
}
