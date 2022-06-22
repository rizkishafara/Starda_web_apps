<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // is_logged_in();
    $this->load->model('M_Website', 'website');
  }
  public function index()
  {
    $data['title'] = "Event Tech";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['newevent'] = $this->website->getnewEvent()->result_array();
    $data['workshop'] = $this->website->getAllWrkEvent()->result_array();
    $data['lomba'] = $this->website->getAllLmbEvent()->result_array();
    $data['webinar'] = $this->website->getAllWebEvent()->result_array();
    $data['testi'] = $this->website->getAllTestimoni()->result_array();
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/index');
    $this->load->view('Templates/webs/footer');
  }
  public function event()
  {
    $data['title'] = "Event Tech";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['event'] = $this->website->getAllEvent()->result_array();
    $data['getcat'] = $this->website->getcategory();
    $data['hrg'] = $this->website->getharga()->result_array();
    // $data['tipe'] = $this->website->getTipeEvent($id);
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/event');
    $this->load->view('Templates/webs/footer');
  }
  public function pricelist()
  {
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['price'] = $this->website->getpriceList()->result_array();
    $data['title'] = "Event Tech";
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/pricelist');
    $this->load->view('Templates/webs/footer');
  }
  public function eventcategory($category)
  {
    $data['title'] = "Event Tech";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['getcat'] = $this->website->getcategory();
    $data['cate'] = $this->website->getcatEvent($category);
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/event_category');
    $this->load->view('Templates/webs/footer');
  }
  public function detail_event($id)
  {
    $data['title'] = "Event Tech";
    $data['getcat'] = $this->website->getcategory();
    $data['detailevent'] = $this->website->getEventId($id);
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/event_detail');
    $this->load->view('Templates/webs/footer');
  }
  public function tipe_event_bayar()
  {
    $data['title'] = "Event Tech";
    // $data['gethrg'] = $this->website->gethrg();
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['event'] = $this->website->getAllEvent()->result_array();
    $data['getcat'] = $this->website->getcategory();
    $data['tipe'] = $this->website->getTipeEvent();
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/event_tipe_bayar');
    $this->load->view('Templates/webs/footer');
  }
  public function tipe_event_gratis()
  {
    $data['title'] = "Event Tech";
    // $data['gethrg'] = $this->website->gethrg();
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['event'] = $this->website->getAllEvent()->result_array();
    $data['getcat'] = $this->website->getcategory();
    $data['tipe'] = $this->website->getTipeEvent();
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/event_tipe_gratis');
    $this->load->view('Templates/webs/footer');
  }
  public function blog()
  {
    $data['title'] = "Event Tech";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['tags'] = $this->website->getAlltagsBlog()->result_array();
    $data['recents'] = $this->website->getAllRecentBlog()->result_array();

    $this->load->library('pagination');
    $config['base_url'] = base_url('website/blog');
    $config['total_rows'] = $this->website->countAlldata();
    $config['per_page'] = 1;

    $config['full_tag_open'] = '<div class="blog-pagination">
    <ul class="justify-content-center">';
    $config['full_tag_close'] = '</ul>
    </div>';
    $config['first_link'] = 'Awal';
    $config['first_tag_open'] = ' <li>';
    $config['first_tag_close'] = ' </li>';

    $config['last_link'] = 'Akhir';
    $config['last_tag_open'] = ' <li>';
    $config['last_tag_close'] = ' </li>';

    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = ' <li>';
    $config['next_tag_close'] = ' </li>';

    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = ' <li>';
    $config['prev_tag_close'] = ' </li>';

    $config['cur_tag_open'] = ' <li class="active"><a href="#">';
    $config['cur_tag_close'] = ' </a></li>';

    $config['num_tag_open'] = ' <li>';
    $config['num_tag_close'] = ' </li>';

    $config['attributes'] = array('class' => 'page-link');
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['allblog'] = $this->website->getAllBlog($config['per_page'], $data['start'])->result_array();

    // $data['tipe'] = $this->website->getTipeEvent($id);
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/blog');
    $this->load->view('Templates/webs/footer');
  }
  public function detail_blog($id)
  {
    $data['title'] = $this->db->get_where('blog', ['slug' => $id])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['tags'] = $this->website->getAlltagsBlog()->result_array();
    $data['recents'] = $this->website->getAllRecentBlog()->result_array();
    $data['detailblog'] = $this->website->getBlogId($id);
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/blog_detail');
    $this->load->view('Templates/webs/footer');
  }
  public function detail_tag($id)
  {
    $data['title'] = "Event Tech";
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['tags'] = $this->website->getAlltagsBlog()->result_array();
    $data['tagsId'] = $this->website->getTagsId($id);
    $data['recents'] = $this->website->getAllRecentBlog()->result_array();
    $data['detailblog'] = $this->website->getBlogId($id);
    $this->load->view('Templates/webs/header', $data);
    $this->load->view('Website/tag_detail');
    $this->load->view('Templates/webs/footer');
  }
}
