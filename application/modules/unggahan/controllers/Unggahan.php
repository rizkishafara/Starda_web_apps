<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unggahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_unggahan');
    }

    public function index()
    {
        $data['title'] = 'Unggahan';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $config['base_url'] = base_url('unggahan/index/');
        $config['total_rows'] = $this->m_unggahan->tampil_unggahan()->num_rows();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 9;
        $from = $this->uri->segment(3);

        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');


        $this->pagination->initialize($config);
        $data['user_produk'] = $this->m_unggahan->data($config['per_page'], $from);
        $data['category'] = $this->m_unggahan->getCategory()->result();


        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('unggahan_view', $data);
        $this->load->view('template/footer_view');
    }
    //Detai data unggahan
    public function detailData($id = null)
    {
        $data['title'] = "Data unggahan";
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $data["unggahan_data"] = $this->m_unggahan->tampil_data($id);
        $data['total_unduh'] = $this->m_unggahan->countUnduh($id);
        $data["gallery"] = $this->m_unggahan->tampil_gallery($id)->result();
        $data["document"] = $this->m_unggahan->tampil_document($id)->result();

        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('data_view', $data);
        $this->load->view('template/footer_view');
    }
    public function search()
    {
        $data['title'] = "unggahan";
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $keyword = $this->input->post('keyword');
        $data['user_produk'] = $this->m_unggahan->get_produk_keyword($keyword)->result();
        $data['category'] = $this->m_unggahan->getCategory()->result();

        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('unggahan_view', $data);
        $this->load->view('template/footer_view');
    }

    public function kategori($id)
    {
        $data['title'] = 'Stakehoder';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $data['category'] = $this->m_unggahan->getCategory()->result();
        $data['user_produk'] = $this->m_unggahan->getUserId($id)->result();

		$this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('unggahan_view', $data);
        $this->load->view('template/footer_view');
	}
}
