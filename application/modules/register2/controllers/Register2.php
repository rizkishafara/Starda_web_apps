<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register2 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user_data.email]', ['is_unique' => 'Email Telah Digunakan.']);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Register';
			$cat['category'] = $this->get_category()->result_array();
			// $cat['subcategory'] = $this->get_subcategory()->result_array();
			$this->load->view('template/header_view', $data);
			$this->load->view('registerv', $cat);
		} else {
			$post = $this->input->post();
			$this->fullname = $post["fullname"];
			$this->email = $post["email"];
			// $this->address_user = $post["address"];
			$this->phone_user = "62" . $post["phone"];
			$this->id_category_user = $post["category"];

			// get id with sql
			// $idsubcat = $post["subcategory"];
			// $subcat = $this->_getIdcat($idsubcat)->row();

			// convert id to string
			// $this->id_category = $subcat->category_id;

			$this->instansi = $post["instansi"];
			
			$this->password =  md5('stakeholder');
			$this->status =  'non active';
			$this->photo_user =  'default.png';

			$this->db->insert('user_data', $this);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Register!, silahkan tunggu maks 2x24 jam untuk aktivasi akun anda</div>');
			redirect('login');
		}
	}
	public function get_category()
	{
		$this->db->select('*');
		$this->db->from('user_kategori');
		return $this->db->get();
	}
	// public function get_subcategory()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('sub_kategori');
	// 	$this->db->join('kategori', 'sub_kategori.id_sub_category = kategori.id_cat', 'left');
	// 	return $this->db->get();
	// }
	// private function _getIdcat($idsubcat)
	// {
	// 	$this->db->select('category_id');
	// 	$this->db->from('sub_kategori');
	// 	$this->db->where('id_sub_category', $idsubcat);
	// 	return $this->db->get();
	// }
}
