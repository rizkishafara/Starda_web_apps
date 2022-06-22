<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_login();
		$this->load->model('m_document');
	}
	public function index()
	{
		$data['title'] = 'Document';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['document'] = $this->m_document->document()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('document/document_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function delete_document($id)
	{
		// delete file di storage
		$post =  $this->m_document->getDocument($id)->row_array();
		$media = $post['name_document'];
		unlink(FCPATH . 'storage/document_user/' . $media);

		$this->db->where('id_document', $id);
		$this->db->delete('alasan_document');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
		redirect('admin/Document');
	}
	public function delete_document_tolak($id)
	{
		// delete file di storage
		$post =  $this->m_document->getDocument($id)->row_array();
		$media = $post['name_document'];
		unlink(FCPATH . 'storage/document_user/' . $media);

		$this->db->where('id_document', $id);
		$this->db->delete('user_document');
		$this->db->where('id_doc', $id);
		$this->db->delete('alasan_document');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
		redirect('admin/Document/doctolak');
	}

	public function docpending()
	{
		$data['title'] = 'Pertinjauan Dokumen';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['docpending'] = $this->m_document->docpending()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('document/docpending_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function doctolak()
	{
		$data['title'] = 'Dokumen Ditolak';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['doctolak'] = $this->m_document->doctolak()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('document/doctolak_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function accept_document($id)
	{
		$this->status_doc = "2";
		$this->verif_date = date("Y-m-d");

		$this->db->update('user_document', $this, array('id_document' => $id));
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disetujui</div>');
		redirect('admin/Document/docpending');
	}
	public function tolak_document($id)
	{
		$this->status_doc = "3";
		$this->db->update('user_document', $this, array('id_document' => $id));

		$alasan = $this->input->post('alasan');
		$data = array(
			'id_doc' => $id,
			'alasan' => $alasan
		);
		$this->db->insert('alasan_document', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil ditolak</div>');
		redirect('admin/Document/docpending');
	}
}
