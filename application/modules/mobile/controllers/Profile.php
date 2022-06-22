<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_profile');
    }
    public function get_profile($resultId)
    {
        $query = $this->m_profile->getDataUser($resultId)->result_array();

        foreach ($query as $row) {
            $response["user"]["id"] = $row['id_user'];
            $response["user"]["nama"] = $row['fullname'];
            $response["user"]["email"] = $row['email'];
            $response["user"]["photo"] = $row['photo_user'];
            $response["user"]["address"] = $row['address_user'];
            $response["user"]["phone"] = substr($row['phone_user'], 2);
            $response["user"]["category"] = $row['category_user'];
            $response["user"]["keahlian"] = $row['keahlian_user'];
            $response["user"]["instansi"] = $row['instansi'];
            $response["user"]["gender"] = $row['gender'];
            $response["user"]["about"] = $row['about'];
            echo json_encode($response);
        }
    }

    public function get_kategori()
    {
        $query = $this->db->get('user_kategori')->result_arraY();

        foreach ($query as $row) {
            // $kategori['semuakategori'][] = array(
            $kategori['semuakategori'][] = array(
                'id_cat' => $row['id_cat'],
                'category_user' => $row['category_user']
            );
            // $kategori['id_cat'] = $row['id_cat'];
            // $kategori['category_user']= $row['category_user'];

        }
        echo json_encode($kategori);
    }
    public function get_keahlian()
    {
        $query = $this->db->get('user_keahlian')->result_arraY();

        foreach ($query as $row) {
            // $kategori['semuakategori'][] = array(
            $keahlian['semuakeahlian'][] = array(
                'id_keahlian' => $row['id_keahlian'],
                'keahlian_user' => $row['keahlian_user']
            );
            // $keahlian['id_cat'] = $row['id_cat'];
            // $keahlian['category_user']= $row['category_user'];

        }
        echo json_encode($keahlian);
    }
    public function update_photo_user($resultId){
        $this->m_profile->editPhoto($resultId);
    }
    public function update_profile($resultId)
    {
        $response = array("error" => FALSE);

        $kat = $this->m_profile->getIdCat($_POST["category"]);
        $ahli = $this->m_profile->getIdKeahlian($_POST["keahlian"]);

        $this->fullname = $_POST["fullname"];
        $this->address_user = $_POST["address"];
        $this->phone_user = "62" . $_POST["phone"];
        $this->id_category_user = $kat->id_cat;
        $this->gender = $_POST["gender"];
        $this->id_keahlian_user = $ahli->id_keahlian;
        $this->instansi = $_POST["instansi"];
        $this->about = $_POST["about"];

        if (!empty($_POST["fullname"] &&
            $_POST["address"] &&
            $_POST["phone"] &&
            $_POST["category"] &&
            $_POST["keahlian"] &&
            $_POST["gender"] &&
            $_POST["instansi"])) {

            $this->db->update("user_data", $this, array('id_user' => $resultId));

            $query = $this->m_profile->getDataUser($resultId)->result_array();
            foreach ($query as $row) {
                $response["error"] = false;
                $response["user"]["id"] = $row['id_user'];
                $response["user"]["nama"] = $row['fullname'];
                $response["user"]["photo"] = $row['photo_user'];
                echo json_encode($response);
            }
        } else {
            $response["error"] = true;
            $response["error_msg"] = "Data tidak boleh kosong";
            echo json_encode($response);
        }
    }
}
