<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_admin->cek_member();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user_data', ['id_user' => $this->session->userdata('id_user')])->row();

        $id = $this->session->userdata('id_user');


        $media = $this->db->select('*');
        $media = $this->db->from('user_produk');
        $media = $this->db->where('id_user', $id);
        $media = $this->db->where('status_produk', '2');
        $media = $this->db->get();
        $data['media'] = $media->num_rows();

        $mediapending = $this->db->select('*');
        $mediapending = $this->db->from('user_produk');
        $mediapending = $this->db->where('id_user', $id);
        $mediapending = $this->db->where('status_produk', '1');
        $mediapending = $this->db->get();
        $data['mediapending'] = $mediapending->num_rows();


        // $data['userdata'] = $this->get('userdata')->result();


        $this->load->view('template/member/header_view', $data);
        $this->load->view('template/member/sidebar_view');
        $this->load->view('template/member/navbar_view', $data);
        $this->load->view('dashboard_v');
        $this->load->view('template/member/footer_view');
    }
    public function chgpswd($id_user)
    {
        $this->form_validation->set_rules('oldpass', 'Password', 'trim|required');
        if ($this->form_validation->run() == true) {
            $this->_changePass($id_user);
        } else {

            $data['title'] = 'Ubah Password';
            $this->load->view('template/header_view', $data);
            $this->load->view('changepswd_v', $data);
        }
    }
    private function _changePass($id_user)
    {
        $oldpass = $this->input->post('oldpass');
        $newpass = $this->input->post('newpass');

        $pass = $this->db->get_where('user_data', ['id_user' => $id_user])->row();
        if ($pass) {
            // $pswd = $this->db->get_where('user_data', ['password' => md5($oldpass)])->row_array();
            $pswd = $pass->password;
            if ($pswd == md5($oldpass)) {
                $this->form_validation->set_rules('newpass', 'Password', 'required|trim|min_length[3]|matches[newpass2]', [
                    'matches' => 'Password dont match',
                    'min_length' => 'Password to short'
                ]);
                $this->form_validation->set_rules('newpass2', 'Password', 'required|trim|matches[newpass]');
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password baru anda tidak sama!</div>');
                    redirect('member/dashboard/chgpswd/' . $id_user);
                } else {

                    $data = [
                        'password' => md5($newpass),
                    ];

                    $this->db->update('user_data', $data, array('id_user' => $id_user));
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil mengubah password</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password lama anda salah!</div>');
                redirect('member/dashboard/chgpswd/' . $id_user);
            }
        }
    }
}
