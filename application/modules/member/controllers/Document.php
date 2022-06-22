<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_member();
		$this->load->model('m_document');
	}
	public function index()
	{
		$data['title'] = 'Document';
		$data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

		$id=$this->session->userdata('id_user');
		$data['document'] = $this->m_document->document($id)->result();
		$data['kategori'] = $this->get_kategori_file()->result_array();

		$this->load->view('template/member/header_view', $data);
		$this->load->view('template/member/sidebar_view');
		$this->load->view('template/member/navbar_view', $data);
		$this->load->view('document/document_v', $data);
		$this->load->view('template/member/footer_view');
	}

	public function add_document($id_user)
    {
        $this->m_document->addDocument($id_user);
        redirect('member/document');
    }
	public function edit_document($id)
    {
        $this->m_document->editDocument($id);
        redirect('member/document');
    }

	public function delete_document($id){
		// delete file di storage
        $post =  $this->m_document->getDocument($id)->row_array();
        $media = $post['name_document'];
        unlink(FCPATH . '/storage/document_user/' . $media);

		$this->db->where('id_document', $id);
        $this->db->delete('user_document');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('member/Document');
	}
	public function get_kategori_file()
	{
		$this->db->select('*');
		$this->db->from('kategori_file');
		return $this->db->get();
	}
}
