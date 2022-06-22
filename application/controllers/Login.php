<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $response = array("error" => FALSE);
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        if ((empty($email)) || (empty($password))) {
            $response["error"] = False;
            $response["error_msg"] = "Kolom tidak boleh kosong";
            echo json_encode($response);
        }

        $query = $this->db->query("SELECT * FROM user_data WHERE email='$email' AND password='$password'");

        foreach ($query->result_array() as $row)

            if (!empty($row)) {
                $response["error"] = TRUE;
                $response["error_msg"] = "Selamat datang " . $row['fullname'];
                $response["user"]["nama"] = $row['fullname'];
                $response["user"]["email"] = $row['email'];
                echo json_encode($response);
            } else {
                $response["error"] = FALSE;
                $response["error_msg"] = "Username atau password salah";
                echo json_encode($response);
            }
    }
}
