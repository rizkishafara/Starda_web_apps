<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Data Stakeholder';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $data['stakeholder_data'] = $this->tampil_data()->result();

        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('data_view', $data);
        $this->load->view('template/footer_view');
    }

    public function tampil_data($id = null)
    {
        $this->db->select("*");
        $this->db->from("user_data");
        $this->db->where("id_user", $id);
        return $this->db->get();
    }


    //Detai data stakeholder
}
