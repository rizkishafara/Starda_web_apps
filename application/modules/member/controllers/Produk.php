<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_member();
		$this->load->model('m_produk');
	}
	public function index()
	{
		$data['title'] = 'Gellery';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$id = $this->session->userdata('id_user');
		$data['produk'] = $this->m_produk->produk($id)->result();
		$data['kategori'] = $this->get_kategori_file()->result_array();

		$post = $data['produk'];
		foreach ($post as $pos) {
			$id_produk = $pos->id_produk;
		}
		if (!$post == "") {
			$data['dokumen'] = $this->m_produk->docPelengkap($id_produk)->result_array();
		}

		$data['kegiatan'] = $this->m_produk->getKegiatan()->result_array();
		// echo json_encode($data['kegiatan']);
		
		// var_dump($data['dokumen'][0]);
		// die;


		$this->load->view('template/member/header_view', $data);
		$this->load->view('template/member/sidebar_view');
		$this->load->view('template/member/navbar_view', $data);
		$this->load->view('produk/produk_v', $data);
		$this->load->view('template/member/footer_view');
	}
	public function add_produk($id_user)
	{
		$this->m_produk->addProduk($id_user);
		redirect('member/produk/produk_pending');
	}
	public function edit_produk($id)
	{
		$this->m_produk->editProduk($id);
		redirect('member/produk/produk_pending');
	}
	public function delete_produk($id)
	{
		// delete file di storage
		$postdoc =  $this->m_produk->docPelengkap($id)->result();
		foreach ($postdoc as $docpost) {
			$docproduk = $docpost->name_document;
			unlink(FCPATH . 'storage/doc_media_user/' . $docproduk);
		}
		$post =  $this->m_produk->getProduk($id)->row_array();
		$produk = $post['name_produk'];
		unlink(FCPATH . 'storage/media_user/' . $produk);

		$this->db->where('id_produk', $id);
		$this->db->delete('user_produk');

		$this->db->where('produk_id', $id);
		$this->db->delete('user_product_document');

		$this->db->where('id_product', $id);
		$this->db->delete('alasan_produk');

		$this->db->where('produk_id', $id);
		$this->db->delete('user_kegiatan');

		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
		redirect('member/Produk');
	}
	public function get_kategori_file()
	{
		$this->db->select('*');
		$this->db->from('kategori_file');
		return $this->db->get();
	}

	public function detail_produk($idproduk)
	{
		$data['title'] = 'Detail Produk';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$data['detail'] = $this->m_produk->detailProduk($idproduk)->result_array();
		$data['dokumen'] = $this->m_produk->docPelengkap($idproduk)->result_array();
		$data['unduhan'] = $this->db->get_where('unduh_produk', ['id_produk_unduh' => $idproduk])->num_rows();
		$data['kategori'] = $this->get_kategori_file()->result_array();
		$data['jml_dokumen'] = $this->db->get_where('user_product_document', ['produk_id' => $idproduk])->num_rows();



		$this->load->view('template/member/header_view', $data);
		$this->load->view('template/member/sidebar_view');
		$this->load->view('template/member/navbar_view', $data);
		$this->load->view('produk/detail_v', $data);
		$this->load->view('template/member/footer_view');
	}
	public function openWord($id_doc)
	{
		$dok = $this->db->get_where('user_product_document', ['id_document' => $id_doc])->row();
		$file = base_url('storage/doc_media_user/' . $dok->name_document);
		$app = new COM("Word.Application");
		$file;
		$app->visible = true;
		$app->Documents->Open($file);
		$app->ActiveDocument->PrintOut();
		$app->ActiveDocument->Close();
		$app->Quit();
	}

	public function download_document($id_doc)
	{
		$post =  $this->_getDocument($id_doc)->row();
		$media = $post->name_document;
		$ext = pathinfo($media, PATHINFO_EXTENSION);
		$download = file_get_contents('storage/doc_media_user/' . $media);
		$file_name = $post->name_document;
		$file_download = substr($file_name, 5) . '.' . $ext;
		force_download($file_download, $download);
	}
	private function _getDocument($id_doc)
	{
		$this->db->select('*');
		$this->db->from('user_product_document');
		$this->db->where('id_document =' . $id_doc);
		return $this->db->get();
	}

	public function produk_pending()
	{
		$data['title'] = 'Karya Ditinjau';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$id = $this->session->userdata('id_user');
		$data['produk'] = $this->m_produk->produkPending($id)->result();
		$data['kategori'] = $this->get_kategori_file()->result_array();
		$data['kegiatan'] = $this->m_produk->getKegiatan()->result_array();

		$this->load->view('template/member/header_view', $data);
		$this->load->view('template/member/sidebar_view');
		$this->load->view('template/member/navbar_view', $data);
		$this->load->view('produk/produkpending_v', $data);
		$this->load->view('template/member/footer_view');
	}
	public function produk_tolak()
	{
		$data['title'] = 'Karya Ditolak';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$id = $this->session->userdata('id_user');
		$data['produk'] = $this->m_produk->produkTolak($id)->result();
		$data['kategori'] = $this->get_kategori_file()->result_array();
		$data['kegiatan'] = $this->m_produk->getKegiatan()->result_array();

		$this->load->view('template/member/header_view', $data);
		$this->load->view('template/member/sidebar_view');
		$this->load->view('template/member/navbar_view', $data);
		$this->load->view('produk/produktolak_v', $data);
		$this->load->view('template/member/footer_view');
	}
	public function edit_dokumen($id)
	{

		$id_prod = $this->db->get_where('user_product_document', ['id_document' => $id])->row();
		$id_produk = $id_prod->produk_id;
		$this->m_produk->editDokumen($id, $id_produk);

		redirect('member/produk/detail_produk/' . $id_produk);
	}
	public function delete_dokumen($id)
	{
		// delete file di storage
		$postdoc =  $this->db->get_where('user_product_document', ['id_document' => $id])->row();
		$docproduk = $postdoc->name_document;
		unlink(FCPATH . 'storage/doc_media_user/' . $docproduk);

		$this->db->where('id_document', $id);
		$this->db->delete('user_product_document');

		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
		redirect('member/Produk/detail_produk/' . $postdoc->produk_id);
	}
	public function add_dokumen($id_produk)
	{
		$this->m_produk->addDokumen($id_produk);

		redirect('member/produk/detail_produk/' . $id_produk);
	}
}
