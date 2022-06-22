<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_profile');
    }

    public function index()
    {
        $data['title'] = 'Profile User';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $data['profile'] = $this->tampil_profile()->row();
        $data['galery'] = $this->tampil_galery()->result();
        $data['document'] = $this->tampil_document()->result();
        $data['category'] = $this->get_category()->result_array();


        $session = $this->session->userdata('id_user');
        if ($session == '') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login!</div>');
            redirect('login');
        } else {
            $this->load->view('template/header_view', $data);
            $this->load->view('template/nav_view', $data);
            $this->load->view('profile_view', $data);
            $this->load->view('template/footer_view');
        }
    }

    public function tampil_profile()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('kategori', 'kategori.id_category = user_data.id_category');
        $this->db->where('user_data.id_user =' . $id_user);
        return $this->db->get();
    }
    public function get_category()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        return $this->db->get();
    }
    public function edit_profile()
    {
        $this->m_profile->editProfile();
        if ($this->m_profile->editProfile()) // call the method from the model
        {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
            redirect('profile');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengubah data</div>');
            redirect('profile');
        }
    }
    public function edit_photo($id_user)
    {
        $this->m_profile->editPhoto($id_user);
        redirect('profile');
    }
    public function add_media($id_user)
    {
        $this->m_profile->addMedia($id_user);
        redirect('profile');
    }
    public function add_document($id_user)
    {
        $this->m_profile->addDocument($id_user);
        redirect('profile');
    }

    public function tampil_galery()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('user_media');
        $this->db->where('id_user =' . $id_user);
        return $this->db->get();
    }
    public function tampil_document()
    {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_user =' . $id_user);
        return $this->db->get();
    }
    public function download_image($id_produk)
    {
        $getiduser = $this->session->userdata('id_user');
        $this->id_user_unduh = $getiduser;
        $this->id_produk_unduh = $id_produk;
        $this->tanggal_unduh = date("Y-m-d");
        $this->db->insert('unduh_produk', $this);


        $post =  $this->_getMedia($id_produk)->row_array();
        $produk = $post['name_produk'];
        $ext = pathinfo($produk, PATHINFO_EXTENSION);
        $download = file_get_contents('storage/media_user/' . $produk);
        $file_name = $post['title_produk'];
        $file_download = $file_name . '.' . $ext;
        force_download($file_download, $download);
    }
    private function _getMedia($id_produk)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->where('id_produk =' . $id_produk);
        return $this->db->get();
    }

    public function download_document($id_doc)
    {
        $post =  $this->_getDocument($id_doc)->row_array();
        $media = $post['name_document'];
        $ext = pathinfo($media, PATHINFO_EXTENSION);
        $download = file_get_contents('storage/document_user/' . $media);
        $file_name = $post['title_document'];
        $file_download = $file_name . '.' . $ext;
        force_download($file_download, $download);
    }
    private function _getDocument($id_doc)
    {
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_document =' . $id_doc);
        return $this->db->get();
    }

    public function hapus_image($id_media)
    {
        // delete file di storage
        $post =  $this->_getMedia($id_media)->row_array();
        $media = $post['name_media'];
        unlink(FCPATH . 'storage/media_user/' . $media);

        // delete file di db
        $this->db->where('id_media', $id_media);
        $this->db->delete('user_media');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Media berhasil dihapus</div>');
        redirect('profile');
    }
    public function hapus_document($id_doc)
    {
        // delete file di storage
        $post =  $this->_getDocument($id_doc)->row_array();
        $media = $post['name_document'];
        unlink(FCPATH . 'storage/document_user/' . $media);

        // delete file di db
        $this->db->where('id_document', $id_doc);
        $this->db->delete('user_document');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Document berhasil dihapus</div>');
        redirect('profile');
    }
    public function chgpswd($id_user)
    {
        $this->form_validation->set_rules('oldpass', 'Password', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->_changePass($id_user);
        } else {

            $data['title'] = 'Ubah Profile';
            $this->load->view('template/header_view', $data);
            $this->load->view('changepswd_view', $data);
        }
    }
    private function _changePass($id_user)
    {
        $oldpass = $this->input->post('oldpass');
        $newpass = $this->input->post('newpass');

        $pass = $this->db->get_where('user_data', ['id_user' => $id_user])->row_array();
        if ($pass) {
            $pswd = $this->db->get_where('user_data', ['password' => md5($oldpass)])->row_array();
            if ($pswd) {
                $this->form_validation->set_rules('newpass', 'Password', 'required|trim|min_length[3]|matches[newpass2]', [
                    'matches' => 'Password dont match',
                    'min_length' => 'Password to short'
                ]);
                $this->form_validation->set_rules('newpass2', 'Password', 'required|trim|matches[newpass]');
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password baru anda tidak sama!</div>');
                    redirect('profile/chgpswd/' . $id_user);
                } else {

                    $data = [
                        'password' => md5($newpass),
                    ];

                    $this->db->insert('user_data', $data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil mengubah password</div>');
                    redirect('profile');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password lama anda salah!</div>');
                redirect('profile/chgpswd/' . $id_user);
            }
        }
    }
}
