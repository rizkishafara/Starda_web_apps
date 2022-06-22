<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keahlian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_login();
        $this->load->model('m_keahlian');
    }
    public function index()
    {
        $data['title'] = 'Keahlian';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['keahlian'] = $this->m_keahlian->keahlian()->result();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('keahlian/keahlian_v', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function add_keahlian()
    {
        $this->m_keahlian->addCategory();
        redirect('admin/Keahlian');
    }
    public function edit_keahlian($id)
    {
        $this->m_keahlian->editCategory($id);
        redirect('admin/Keahlian');
    }
    public function delete_keahlian($id)
    {

        $this->db->where('id_keahlian', $id);
        $this->db->delete('user_keahlian');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Keahlian');
    }
}
