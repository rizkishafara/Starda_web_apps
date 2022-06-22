<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unggah extends CI_Controller
{
   function __construct()
	{
		parent::__construct();
		$this->load->model('m_unggah');
	}
   public function index()
   {
      $target_dir = "storage/coba/";
      $target_file_name1 = $target_dir . basename($_FILES["file"]["name"]);
      $target_file_name2 = $target_dir . basename($_FILES["file1"]["name"]);
      $response = array();
      // Check if image file is an actual image or fake image  
      if (isset($_FILES["file"]) && isset($_FILES["file1"])) {
         if (
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name1)
            && move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file_name2)
         ) {
            $success = true;
            $message = "Successfully Uploaded";
         } else {
            $success = false;
            $message = "Error while uploading";
         }
      } else {
         $success = false;
         $message = "Required Field Missing";
      }
      $response["success"] = $success;
      $response["message"] = $message;
      echo json_encode($response);
   }
   public function unggah_produk()
   {
      $idUser = $this->input->post('idUser');
      $this->m_unggah->unggahProduk($idUser);
   }
   public function get_kategori_produk()
    {
        $query = $this->db->get('kategori_file')->result_arraY();

        foreach ($query as $row) {
            $kategoriproduk['semuakategoriproduk'][] = array(
                'id_kategori_file' => $row['id_kategori_file'],
                'kategori_file' => $row['kategori_file']
            );

        }
        echo json_encode($kategoriproduk);
    }
}
