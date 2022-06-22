<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_login();
        $this->load->model('m_kegiatan');
    }
    public function index()
    {
        $data['title'] = 'Kegiatan';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['kegiatan'] = $this->m_kegiatan->kegiatan()->result();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('kegiatan/kegiatan_v', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function add_kegiatan()
    {
        $this->m_kegiatan->addCategory();
        redirect('admin/Kegiatan');
    }
    public function edit_kegiatan($id)
    {
        $this->m_kegiatan->editCategory($id);
        redirect('admin/Kegiatan');
    }
    public function delete_kegiatan($id)
    {

        $this->db->where('id_kegiatan', $id);
        $this->db->delete('daftar_kegiatan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Kegiatan');
    }
}
