<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $email=$this->input->post('email');
        // echo $email;die;
        $cekEmail = $this->_getEmail($email);
        if ($cekEmail==null){
            $post = $this->input->post();
            $this->fullname = $post["fullname"];
            $this->email = $post["email"];
            $this->phone_user = "62" . $post["phone"];
            $this->address_user = "";
            $this->about = "";
            
            $category = $post["selectedKategori"];
            $getIdCategory = $this->_getIdCategory($category)->row();
            $idCategory = $getIdCategory->id_cat;

            $this->id_category_user = $idCategory;
            $this->instansi = $post["instansi"];

            $this->password =  md5('stakeholder');
            $this->status =  'non active';
            $this->photo_user =  'default.png';

            $this->db->insert('user_data', $this);

            $response["success"] = true;
            $response["message"] = "Berhasil Register!, silahkan tunggu maks 2x24 jam untuk aktivasi akun anda";
        }else{
            $response["success"] = false;
            $response["message"] = "Email yang anda daftarkan telah digunakan";
        }

        echo json_encode($response);
    }
    private function _getIdCategory($category)
    {
        return $this->db->get_where('user_kategori', ['category_user' => $category]);
    }
    private function _getEmail($email){
        $this->db->select('email');
        $this->db->from('user_data');
		$this->db->where('email', $email);
		return $this->db->get()->row();
    }
}
