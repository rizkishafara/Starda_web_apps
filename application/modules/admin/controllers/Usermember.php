<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermember extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_login();
        $this->load->model('m_usermember');
    }
    public function index()
    {
        $data['title'] = 'Usermember';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['usermember'] = $this->m_usermember->usermember()->result();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('usermember/usermember_v', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function add_member()
    {
        $this->m_usermember->addMember();
        redirect('admin/Usermember');
    }
    public function edit_member($id)
    {
        $this->m_usermember->editMember($id);
        redirect('admin/Usermember');
    }
    public function delete_member($id)
    {
        $this->m_usermember->deleteMember($id);
       
        redirect('admin/Usermember');
    }
    // public function detail_member($id){
    //     $data['title'] = 'Usermember';
    //     $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

    //     $data['usermember'] = $this->m_usermember->getusermember($id)->row();
    //     $data["galery"] = $this->m_usermember->tampil_galery($id)->result();
    //     $data["document"] = $this->m_usermember->tampil_document($id)->result();

    //     $this->load->view('template/admin/header_view', $data);
    //     $this->load->view('template/admin/sidebar_view');
    //     $this->load->view('template/admin/navbar_view', $data);
    //     $this->load->view('usermember/detail_v', $data);
    //     $this->load->view('template/admin/footer_view');
    // }
    // public function resetpass_member($id)
    // {
    //     $this->m_usermember->resetpassMember($id);
    //     redirect('admin/Usermember');
    // }
}
