<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_login();
		$this->load->model('m_dashboard');
	}
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['useradmin'] = $this->db->count_all('admin');
		$data['tahun'] = $this->m_dashboard->getYear()->result();
		// echo json_encode($data['tahun']);
		// $tahun = date("Y");
		if ($this->input->post('thn', TRUE)) {
			$tahun = $this->input->post('thn', TRUE);
		} else {
			$tahun = date("Y");
		}
		$data['jumlah_produk'] = $this->m_dashboard->getJumlahUnggah($tahun);

		$data['kategori_user'] = $this->m_dashboard->getKategoriUser()->result_array();
		$data['jumlah_user_kat'] = $this->m_dashboard->getUser();

		$usermem = $this->db->select('*');
		$usermem = $this->db->from('user_data');
		$usermem = $this->db->where('status', 'active');
		$usermem = $this->db->get();
		$data['usermember'] = $usermem->num_rows();

		$delaymem = $this->db->select('*');
		$delaymem = $this->db->from('user_data');
		$delaymem = $this->db->where('status', 'non active');
		$delaymem = $this->db->get();
		$data['delaymember'] = $delaymem->num_rows();

		$mediapending = $this->db->select('*');
		$mediapending = $this->db->from('user_produk');
		$mediapending = $this->db->where('status_produk', '1');
		$mediapending = $this->db->get();
		$data['mediapending'] = $mediapending->num_rows();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('dashboard');
		$this->load->view('template/admin/footer_view');
	}
	public function jumlah_produk()
	{
		$tahun = $this->input->post('thn', TRUE);
		// $tahun = '2021';
		$data['jumlah_produk'] = $this->m_dashboard->getJumlahUnggah($tahun);
		// echo json_encode($data['jumlah_produk']);
	}
}
