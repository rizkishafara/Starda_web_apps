<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Media extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_login();
		$this->load->model('m_media');
	}
	public function index()
	{
		$data['title'] = 'Produk';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['media'] = $this->m_media->media()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('media/media_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function delete_media($id)
	{
		// delete file di storage
		$postdoc =  $this->m_media->docPelengkap($id)->result();
		foreach ($postdoc as $docpost) {
			$docproduk = $docpost->name_document;
			unlink(FCPATH . 'storage/doc_media_user/' . $docproduk);
		}

		$post =  $this->m_media->getMedia($id)->row_array();
		$media = $post['name_produk'];
		unlink(FCPATH . 'storage/media_user/' . $media);

		$this->db->where('id_produk', $id);
		$this->db->delete('user_produk');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
		redirect('admin/Media');
	}
	public function delete_media_tolak($id)
	{
		// delete file di storage
		$postdoc =  $this->m_media->docPelengkap($id)->result();
		foreach ($postdoc as $docpost) {
			$docproduk = $docpost->name_document;
			unlink(FCPATH . 'storage/doc_media_user/' . $docproduk);
		}

		$post =  $this->m_media->getMedia($id)->row_array();
		$media = $post['name_produk'];
		unlink(FCPATH . 'storage/media_user/' . $media);

		$this->db->where('id_produk', $id);
		$this->db->delete('user_produk');
		$this->db->where('id_product', $id);
		$this->db->delete('alasan_produk');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
		redirect('admin/Media/mediatolak');
	}
	public function mediapending()
	{
		$data['title'] = 'Pertinjauan Produk';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['mediapending'] = $this->m_media->mediapending()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('media/mediapending_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function mediatolak()
	{
		$data['title'] = 'Produk Ditolak';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['mediatolak'] = $this->m_media->mediatolak()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('media/mediatolak_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function accept_media($id)
	{
		$this->status_produk = "2";
		$this->verif_date = date("Y-m-d");

		$this->db->update('user_produk', $this, array('id_produk' => $id));
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disetujui</div>');
		redirect('admin/Media/mediapending');
	}
	public function tolak_media($id)
	{
		$this->status_produk = "3";
		$this->db->update('user_produk', $this, array('id_produk' => $id));

		$alasan = $this->input->post('alasan');
		$data = array(
			'id_product' => $id,
			'alasan' => $alasan
		);
		$this->db->insert('alasan_produk', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil ditolak</div>');
		redirect('admin/Media/mediapending');
	}

	public function detail_produk($idproduk)
	{
		$data['title'] = 'Detail Produk';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['detail'] = $this->m_media->detailProduk($idproduk)->row();
		$data['kegiatan'] = $this->m_media->kegiatanProduk($idproduk)->row();
		$data['dokumen'] = $this->m_media->docPelengkap($idproduk)->result();
		$data['unduhan'] = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $idproduk])->num_rows();
		// var_dump($data['dokumen']);die;

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('media/detail_v', $data);
		$this->load->view('template/admin/footer_view');
	}
}
