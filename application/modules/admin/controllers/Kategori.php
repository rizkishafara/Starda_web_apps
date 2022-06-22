<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_login();
        $this->load->model('m_category');
    }
    public function index()
    {
        $data['title'] = 'Kategori';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['category'] = $this->m_category->category()->result();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('category/category_vbaru', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function add_category()
    {
        $this->m_category->addCategory();
        redirect('admin/Kategori');
    }
    public function add_subcategory()
    {
        $this->m_category->addSubcategory();
        redirect('admin/Kategori');
    }
    public function edit_category($id)
    {
        $this->m_category->editCategory($id);
        redirect('admin/Kategori');
    }
    public function edit_subcategory($id)
    {
        $this->m_category->editSubcategory($id);
        redirect('admin/Kategori');
    }
    public function delete_category($id)
    {

        $this->db->where('id_cat', $id);
        $this->db->delete('user_kategori');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Kategori');
    }
    public function delete_subcategory($id)
    {

        $this->db->where('id_sub_category', $id);
        $this->db->delete('sub_kategori');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Kategori');
    }
}
