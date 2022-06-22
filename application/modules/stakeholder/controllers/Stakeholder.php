<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stakeholder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_stakeholder');
    }

    public function index()
    {
        $data['title'] = 'Stakehoder';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $config['base_url'] = base_url('stakeholder/index/');
        $config['total_rows'] = $this->m_stakeholder->tampil_stakeholder()->num_rows();
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
        $data['user_data'] = $this->m_stakeholder->data($config['per_page'], $from);
        $data['category'] = $this->m_stakeholder->getCategory()->result();


        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('stakeholder_view', $data);
        $this->load->view('template/footer_view');
    }
    //Detai data stakeholder
    public function detailData($id = null)
    {
        $data['title'] = "Data Stakeholder";
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $data["stakeholder_data"] = $this->m_stakeholder->tampil_data($id);
        $data["kegiatan"] = $this->m_stakeholder->tampil_kegiatan($id)->result();
        $data["gallery"] = $this->m_stakeholder->tampil_gallery($id)->result();
        // $data["document"] = $this->m_stakeholder->tampil_document($id)->result();

        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('data_view', $data);
        $this->load->view('template/footer_view');
    }
    public function search()
    {
        $data['title'] = "Stakeholder";
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();
        $keyword = $this->input->post('keyword');
        $data['user_data'] = $this->m_stakeholder->get__keyword($keyword)->result();
        $data['category'] = $this->m_stakeholder->getCategory()->result();

        $this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('stakeholder_view', $data);
        $this->load->view('template/footer_view');

        // $config['base_url'] = base_url('stakeholder/search?keyword=' . $keyword);
        // $config['total_rows'] = $this->m_stakeholder->tampil_search($keyword)->num_rows();
        // $data['total_rows'] = $config['total_rows'];
        // $config['per_page'] = 2;
        // $from = $this->uri->segment(4);

        // $config['full_tag_open'] = '<nav><ul class="pagination">';
        // $config['full_tag_close'] = '</ul></nav>';

        // $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="">';
        // $config['cur_tag_close'] = '</a></li>';
        // $config['num_tag_open'] = '<li class="page-item">';
        // $config['num_tag_close'] = '</li>';

        // $config['attributes'] = array('class' => 'page-link');


        // $this->pagination->initialize($config);
        // $data['user_search'] = $this->m_stakeholder->dataSearch($config['per_page'], $from, $keyword);


        // $this->load->view('template/header_view', $data);
        // $this->load->view('template/nav_view', $data);
        // $this->load->view('search_view', $data);
        // $this->load->view('template/footer_view');
    }

    public function kategori($id)
    {
        $data['title'] = 'Stakehoder';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $data['category'] = $this->m_stakeholder->getCategory()->result();
        $data['user_data'] = $this->m_stakeholder->getUserId($id)->result();

		$this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('stakeholder_view', $data);
        $this->load->view('template/footer_view');
	}
    public function detail_produk($idproduk)
	{
		$data['title'] = 'Detail Produk';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$data['detail'] = $this->m_stakeholder->detailProduk($idproduk)->row();
		$data['dokumen'] = $this->m_stakeholder->docPelengkap($idproduk)->result();
        $data['kegiatan'] = $this->m_stakeholder->produkKegiatan($idproduk)->row();
        
		$data['unduhan'] = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $idproduk])->num_rows();
		// var_dump($data['dokumen']);die;

		$this->load->view('template/header_view', $data);
        $this->load->view('template/nav_view', $data);
        $this->load->view('detail_produk', $data);
        $this->load->view('template/footer_view');
	}

    
}
