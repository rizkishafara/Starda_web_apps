<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stakeholder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_stakeholder');
    }
    public function index(){
        $query = $this->m_stakeholder->getAllStakeholders()->result();
        echo json_encode($query);
    }

    public function get_karya_stakeholder($id){
        $query = $this->m_stakeholder->getKaryaStakeholder($id)->result();
        // $query = $this->db->get_where('user_kategori', ['category_user' => $category]);
        echo json_encode($query);
    }

    public function get_dokumen($id){
        $query = $this->m_stakeholder->getDokumenKarya($id)->result();
        echo json_encode($query);
    }

    
    public function search_stakeholder(){
        $keyword = $this->input->post('keyword');
        $query = $this->m_stakeholder->getUserKeyword($keyword)->result();
        echo json_encode($query);
    }
}