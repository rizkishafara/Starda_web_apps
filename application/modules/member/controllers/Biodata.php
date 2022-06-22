<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_member();
		$this->load->model('m_biodata');
	}
	public function index()
	{
		$data['title'] = 'Biodata';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$id = $this->session->userdata('id_user');
		$data['biodata'] = $this->m_biodata->biodata($id)->row();
		$data['category'] = $this->m_biodata->getCategory()->result_array();
		$data['keahlian'] = $this->m_biodata->getKeahlian()->result_array();
		// $data['subcategory'] = $this->m_biodata->getSubcategory()->result_array();
		

		$this->load->view('template/member/header_view', $data);
		$this->load->view('template/member/sidebar_view');
		$this->load->view('template/member/navbar_view', $data);
		$this->load->view('biodata/biodata_v');
		$this->load->view('template/member/footer_view');
	}
	public function edit_photo($id_user)
    {
        $this->m_biodata->editPhoto($id_user);
        redirect('member/biodata');
    }
	public function save_bio($id)
	{
		$this->m_biodata->saveBio($id);
        redirect('member/biodata');
	}
}
