<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
* Simple_login Class
* Class ini digunakan untuk fitur login, proteksi halaman dan
logout
*/
class Login_admin
{
    // SET SUPER GLOBAL
    var $CI = NULL;
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    /*cek username dan password pada table users, jika ada set
session berdasar data user daritable users.
* @param string username dari input form
* @param string password dari input form*/
    public function login($username_admin, $password_admin)
    {
        //cek username dan password
        $query = $this->CI->db->get_where('admin', array('username_admin' => $username_admin, 'password_admin' => md5($password_admin)));
        if ($query->num_rows() == 1) {
            //ambil data user berdasar username
            $row = $this->CI->db->query('SELECT id_admin FROM admin where username_admin = "' . $username_admin . '"');
            $admin = $row->row();
            $id = $admin->id_admin;

            // var_dump($id);
            // die;
            //set session user
            $this->CI->session->set_userdata('username_admin', $username_admin);
            $this->CI->session->set_userdata('id_login', uniqid(rand()));
            $this->CI->session->set_userdata('id_admin',$id);
            redirect(site_url('admin/dashboard'));
        } else {
            //jika tidak ada, set notifikasi dalam flashdata.
            $this->CI->session->set_flashdata('gagal', 'Username atau password anda salah,silakan coba lagi.. ');
            //redirect ke halaman login
            redirect(site_url('admin/login'));
        }
        return false;
    }
    /**
     * Cek session login, jika tidak ada, set notifikasi dalam flashdata, lalu dialihkan ke halaman
     * login
     */
    public function cek_login()
    {
        //cek session username
        if ($this->CI->session->userdata('username_admin') == '') {
            //set notifikasi
            $this->CI->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda belum login!</div>');
            //alihkan ke halaman login
            redirect(base_url('admin/login'));
        }
    }

    public function cek_member()
    {
        //cek session username
        if ($this->CI->session->userdata('id_user') == '') {
            //set notifikasi
            $this->CI->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda belum login!</div>');
            //alihkan ke halaman login
            redirect(base_url('login'));
        }
    }


    /**
     * Hapus session, lalu set notifikasi kemudian di alihkan
     * ke halaman login
     */
    public function logout()
    {
        $this->CI->session->unset_userdata('username_admin');
        $this->CI->session->unset_userdata('id_login');
        $this->CI->session->unset_userdata('id_admin');
        $this->CI->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil logout</div>');
        redirect(base_url('admin/login'));
    }
    public function logoutMember()
    {
        $this->CI->session->unset_userdata('id_login');
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil logout</div>');
        redirect(base_url('login'));
    }
}
