<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Userdata extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_login();
        $this->load->model('m_userdata');
        $this->load->library('Pdf');
    }
    public function index()
    {
        $data['title'] = 'Userdata';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['userdata'] = $this->m_userdata->userdata()->result();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('userdata/userdata_v', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function add_data()
    {
        $this->m_userdata->adddata();
        redirect('admin/Userdata');
    }
    public function tambah_kegiatan_user($id)
    {
        $this->m_userdata->addKegiatan($id);
        redirect('admin/Userdata/detail_data/' . $id);
    }
    public function ubah_kegiatan_user($idedit)
    {
        $this->m_userdata->editKegiatan($idedit);
        $iduser = $this->input->post('id_user');
        redirect('admin/Userdata/detail_data/' . $iduser);
    }
    public function hapus_kegiatan_user($idhapus)
    {
        $idusers = $this->_getIdUser($idhapus)->row();
        $id_user = $idusers->user_id;
        $this->m_userdata->deleteKegiatan($idhapus);
        redirect('admin/Userdata/detail_data/' . $id_user);
    }
    private function _getIdUser($idhapus)
    {
        $this->db->select('user_id');
        $this->db->from('user_kegiatan');
        $this->db->where('id_user_kegiatan =' . $idhapus);
        return $this->db->get();
    }
    public function edit_data($id)
    {
        $this->m_useradmin->editdata($id);
        redirect('admin/Userdata');
    }
    public function delete_data($id)
    {
        // delete profile
        $profile = $this->db->get_where('user_data', ['id_user' => $id])->row();
        unlink(FCPATH . 'storage/profile_user/' . $profile->photo_user);

        // delete user on table
        $this->db->where('id_user', $id);
        $this->db->delete('user_data');

        // delete media user
        $media = $this->db->get_where('user_produk', ['id_user' => $id])->result_array();

        foreach ($media as $m) {
            unlink(FCPATH . 'storage/media_user/' . $m['name_produk']);

            // delete document pelengkap user
            $document = $this->db->get_where('user_product_document', ['produk_id' => $m['id_produk']])->result_array();
            foreach ($document as $doc) {
                unlink(FCPATH . 'storage/doc_media_user/' . $doc['name_document']);
            }
            $this->db->where('produk_id', $m['id_produk']);
            $this->db->delete('user_product_document');
        }
        $this->db->where('id_user', $id);
        $this->db->delete('user_produk');

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
        redirect('admin/Userdata');
    }
    public function detail_data($id)
    {
        $data['title'] = 'Userdata';
        $data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

        $data['userdata'] = $this->m_userdata->getuserData($id)->row();
        $data["galery"] = $this->m_userdata->tampil_galery($id)->result();
        // $data["document"] = $this->m_userdata->tampil_document($id)->result();
        $data["kegiatan"] = $this->m_userdata->tampil_kegiatan($id)->result();
        $data["listkegiatan"] = $this->m_userdata->list_kegiatan()->result_array();

        $this->load->view('template/admin/header_view', $data);
        $this->load->view('template/admin/sidebar_view');
        $this->load->view('template/admin/navbar_view', $data);
        $this->load->view('userdata/detail_v', $data);
        $this->load->view('template/admin/footer_view');
    }
    public function export_pdf($id)
    {
        $data['result'] = $this->m_userdata->getDataExport($id);
        $this->load->view('userdata/cetak_pdf', $data);
    }
    public function export_excel($id)
    {
        $this->m_userdata->getDataExcel($id);
    }
    public function export_user_excel()
    {
        $this->m_userdata->getUsersExport();
    }
}
