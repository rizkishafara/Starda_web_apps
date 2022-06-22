<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategorifile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_login();
        $this->load->model('m_categoryfile');
    }
    public function index()
    {
        $data['title'] = 'Kategori File';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['categoryfile'] = $this->m_categoryfile->categoryfile()->result();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('categoryfile/categoryfile_v', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function add_categoryfile()
    {
        $this->m_categoryfile->addCategoryFile();
        redirect('admin/Kategorifile');
    }
    public function edit_categoryfile($id)
    {
        $this->m_categoryfile->editCategoryFile($id);
        redirect('admin/Kategorifile');
    }
    public function delete_categoryfile($id)
    {
        $this->db->where('id_kategori_file', $id);
        $this->db->delete('kategori_file');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Kategorifile');
    }
}
