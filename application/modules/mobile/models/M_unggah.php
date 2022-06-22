<?php
require('./application/third_party/php-ffmpeg/vendor/autoload.php');

class m_unggah extends CI_Model
{
    // public function unggahProduk($idUser)
    // {
    //     $response = array("error" => FALSE);
    //     $random_code = random_string('alnum', 15);

    //     if (!empty($_FILES['file']) && !empty($_FILES['file1'])) {
    //         $config['upload_path']          = 'storage/media_user';
    //         $config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv|mpeg';
    //         $random_code = random_string('alnum', 15);
    //         $config['file_name'] = $idUser . '_produk' . $random_code;
    //         $config['overwrite']            = true;
    //         $config['encrypt_name']         = False;
    //         $config['max_size']             = 102400;

    //         $this->upload->initialize($config);

    //         if (!$this->upload->do_upload('file')) {
    //             $error = array('error' => $this->upload->display_errors());
    //             $success = false;
    //             $message = "Produk tidak memenuhi syarat";
    //         } else {
    //             $file = $this->upload->data();

    //             $fl = new SplFileInfo($file["file_name"]);
    //             $ext = $fl->getExtension();

    //             if ($ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
    //                 $this->id_cat_file = "2";
    //             } else if ($ext == "mp4" or $ext  == "mkv") {
    //                 $this->id_cat_file = "1";
    //             } else {
    //                 unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
    //                 $success = false;
    //                 $message = "Produk gagal ditambahkan";
    //             }
    //             $post = $this->input->post();

    //             $kat = $this->_getIdCat($post["kategori"]);

    //             $this->id_kategori = $kat->id_kategori_file;
    //             $this->title_produk = $post["judul"];
    //             $this->desc_produk = $post["deskripsi"];
    //             $this->name_produk = $file["file_name"];
    //             $this->id_user = $idUser;
    //             $this->upload_date = date("Y-m-d");

    //             $this->db->insert("user_produk", $this);

    //             $filename = $file['file_name'];
    //             $id_produk = $this->db->get_where('user_produk', ['name_produk' => $filename])->row();
    //             $id_prod = $id_produk->id_produk;

    //             $datakegiatan = array(
    //                 'produk_id' => $id_prod,
    //                 'kegiatan' => $this->input->post("kegiatan"),
    //                 'tanggal_kegiatan' => $this->input->post("tanggalKegiatan")
    //             );

    //             $this->db->insert("user_kegiatan", $datakegiatan);

    //             if (!empty($_FILES['file1']['name'])) {

    //                 $_FILES['file']['name'] = $_FILES['file1']['name'];
    //                 $_FILES['file']['type'] = $_FILES['file1']['type'];
    //                 $_FILES['file']['tmp_name'] = $_FILES['file1']['tmp_name'];
    //                 $_FILES['file']['error'] = $_FILES['file1']['error'];
    //                 $_FILES['file']['size'] = $_FILES['file1']['size'];

    //                 $config['upload_path']          = 'storage/doc_media_user';
    //                 $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
    //                 $config['overwrite']            = true;
    //                 $random_code                    = random_string('alnum', 5);
    //                 $config['file_name']            = $random_code . $_FILES['file1']['name'];
    //                 $config['encrypt_name']         = False;
    //                 $config['max_size']             = 10400;

    //                 $this->load->library('upload', $config);
    //                 $this->upload->initialize($config);


    //                 if (!$this->upload->do_upload('file')) {
    //                     $error = array('error' => $this->upload->display_errors());
    //                     $success = false;
    //                     $message = "Dokumen tidak memenuhi syarat";
    //                 } else {
    //                     $file = $this->upload->data();
    //                     $fl = new SplFileInfo($file["file_name"]);
    //                     $extdoc = $fl->getExtension();

    //                     if ($extdoc == "doc" or $extdoc  == "docx") {
    //                         $data['id_cat_doc'] = "3";
    //                     } else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
    //                         $data['id_cat_doc'] = "4";
    //                     } else if ($extdoc == "pdf") {
    //                         $data['id_cat_doc'] = "5";
    //                     } else {
    //                         unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
    //                         $success = false;
    //                         $message = "Document gagal ditambahkan";
    //                     }
    //                     $data['produk_id'] = $id_prod;
    //                     $data['name_document'] = $file["file_name"];

    //                     $this->db->insert('user_product_document', $data);
    //                     $success = true;
    //                     $message = "Produk berhasil diunggah";

    //                     if (!empty($_FILES['file2']['name'])) {

    //                         $_FILES['file2']['name'] = $_FILES['file2']['name'];
    //                         $_FILES['file2']['type'] = $_FILES['file2']['type'];
    //                         $_FILES['file2']['tmp_name'] = $_FILES['file2']['tmp_name'];
    //                         $_FILES['file2']['error'] = $_FILES['file2']['error'];
    //                         $_FILES['file2']['size'] = $_FILES['file2']['size'];

    //                         $config['upload_path']          = 'storage/doc_media_user';
    //                         $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
    //                         $config['overwrite']            = true;
    //                         $random_code                    = random_string('alnum', 5);
    //                         $config['file_name']            = $random_code . $_FILES['file2']['name'];
    //                         $config['encrypt_name']         = False;
    //                         $config['max_size']             = 10400;

    //                         $this->load->library('upload', $config);
    //                         $this->upload->initialize($config);


    //                         if (!$this->upload->do_upload('file2')) {
    //                             $error = array('error' => $this->upload->display_errors());
    //                             $success = false;
    //                             $message = "Dokumen 2 tidak memenuhi syarat";
    //                         } else {
    //                             $file = $this->upload->data();
    //                             $fl = new SplFileInfo($file["file_name"]);
    //                             $extdoc = $fl->getExtension();

    //                             if ($extdoc == "doc" or $extdoc  == "docx") {
    //                                 $data2['id_cat_doc'] = "3";
    //                             } else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
    //                                 $data2['id_cat_doc'] = "4";
    //                             } else if ($extdoc == "pdf") {
    //                                 $data2['id_cat_doc'] = "5";
    //                             } else {
    //                                 unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
    //                                 $success = false;
    //                                 $message = "Document gagal ditambahkan";
    //                             }
    //                             $data2['produk_id'] = $id_prod;
    //                             $data2['name_document'] = $file["file_name"];

    //                             $this->db->insert('user_product_document', $data2);
    //                             $success = true;
    //                             $message = "Produk berhasil diunggah";

    //                             if (!empty($_FILES['file3']['name'])) {

    //                                 $_FILES['file3']['name'] = $_FILES['file3']['name'];
    //                                 $_FILES['file3']['type'] = $_FILES['file3']['type'];
    //                                 $_FILES['file3']['tmp_name'] = $_FILES['file3']['tmp_name'];
    //                                 $_FILES['file3']['error'] = $_FILES['file3']['error'];
    //                                 $_FILES['file3']['size'] = $_FILES['file3']['size'];

    //                                 $config['upload_path']          = 'storage/doc_media_user';
    //                                 $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
    //                                 $config['overwrite']            = true;
    //                                 $random_code                    = random_string('alnum', 5);
    //                                 $config['file_name']            = $random_code . $_FILES['file3']['name'];
    //                                 $config['encrypt_name']         = False;
    //                                 $config['max_size']             = 10400;

    //                                 $this->load->library('upload', $config);
    //                                 $this->upload->initialize($config);


    //                                 if (!$this->upload->do_upload('file3')) {
    //                                     $error = array('error' => $this->upload->display_errors());
    //                                     $success = false;
    //                                     $message = "Dokumen 3 tidak memenuhi syarat";
    //                                 } else {
    //                                     $file = $this->upload->data();
    //                                     $fl = new SplFileInfo($file["file_name"]);
    //                                     $extdoc = $fl->getExtension();

    //                                     if ($extdoc == "doc" or $extdoc  == "docx") {
    //                                         $data3['id_cat_doc'] = "3";
    //                                     } else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
    //                                         $data3['id_cat_doc'] = "4";
    //                                     } else if ($extdoc == "pdf") {
    //                                         $data3['id_cat_doc'] = "5";
    //                                     } else {
    //                                         unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
    //                                         $success = false;
    //                                         $message = "Document gagal ditambahkan";
    //                                     }
    //                                     $data3['produk_id'] = $id_prod;
    //                                     $data3['name_document'] = $file["file_name"];

    //                                     $this->db->insert('user_product_document', $data3);
    //                                     $success = true;
    //                                     $message = "Produk berhasil diunggah";
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             } else {
    //                 unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
    //                 $success = false;
    //                 $message = "Gagal ditambahkan";
    //             }
    //         }
    //     }
    //     $response["success"] = $success;
    //     $response["message"] = $message;
    //     echo json_encode($response);
    // }
    public function unggahProduk($idUser)
    {
        $random_code = random_string('alnum', 15);

        if (!empty($_FILES['file']) && !empty($_FILES['fileDoc'])) {
            $config['upload_path']          = 'storage/media_user';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv|mpeg';
            $random_code = random_string('alnum', 15);
            $config['file_name'] = $idUser . '_produk' . $random_code;
            $config['overwrite']            = true;
            $config['encrypt_name']         = False;
            $config['max_size']             = 102400;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                $success = false;
                $message = "Produk tidak memenuhi syarat";
            } else {
                $file = $this->upload->data();

                $fl = new SplFileInfo($file["file_name"]);
                $ext = $fl->getExtension();

                if ($ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
                    $this->id_cat_file = "2";
                } else if ($ext == "mp4" or $ext  == "mkv") {
                    $this->id_cat_file = "1";
                } else {
                    unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
                    $success = false;
                    $message = "Produk gagal ditambahkan";
                }
                $post = $this->input->post();

                $kat = $this->_getIdCat($post["kategori"]);

                $this->id_kategori = $kat->id_kategori_file;
                $this->title_produk = $post["judul"];
                $this->desc_produk = $post["deskripsi"];
                $this->name_produk = $file["file_name"];
                $this->id_user = $idUser;
                $this->upload_date = date("Y-m-d");

                $this->db->insert("user_produk", $this);

                $filename = $file['file_name'];
                $id_produk = $this->db->get_where('user_produk', ['name_produk' => $filename])->row();
                $id_prod = $id_produk->id_produk;

                $data = array(
                    'produk_id' => $id_prod,
                    'kegiatan' => $this->input->post("kegiatan"),
                    'tanggal_kegiatan' => $this->input->post("tgl_kegiatan")
                );

                $this->db->insert("user_kegiatan", $data);

                // $id_produk = $this->_getIdProduk($filename);

                if (!empty($_FILES['fileDoc'])) {


                    $data = [];

                    $jumlah_doc = count($_FILES['fileDoc']['name']);
                    // var_dump($jumlah_doc);die;
                    for ($i = 0; $i < $jumlah_doc; $i++) {


                        if (!empty($_FILES['fileDoc']['name'][$i])) {

                            $_FILES['file']['name'] = $_FILES['fileDoc']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['fileDoc']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['fileDoc']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['fileDoc']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['fileDoc']['size'][$i];

                            $config['upload_path']          = 'storage/doc_media_user';
                            $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
                            $config['overwrite']            = true;
                            $random_code                    = random_string('alnum', 5);
                            $config['file_name']            = $random_code . $_FILES['fileDoc']['name'][$i];
                            $config['encrypt_name']         = False;
                            $config['max_size']             = 10400;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);


                            if (!$this->upload->do_upload('file')) {
                                $error = array('error' => $this->upload->display_errors());
                                $success = false;
                                $message = "Dokumen tidak memenuhi syarat";
                            } else {
                                $file = $this->upload->data();
                                $fl = new SplFileInfo($file["file_name"]);
                                $extdoc = $fl->getExtension();

                                if ($extdoc == "doc" or $extdoc  == "docx") {
                                    $data['id_cat_doc'] = "3";
                                } else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
                                    $data['id_cat_doc'] = "4";
                                } else if ($extdoc == "pdf") {
                                    $data['id_cat_doc'] = "5";
                                } else {
                                    unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
                                    return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document gagal ditambahkan</div>');
                                }
                                $data['produk_id'] = $id_prod;
                                $data['name_document'] = $file["file_name"];

                                $this->db->insert('user_product_document', $data);
                                $success = true;
                                $message = "Berhasil diunggah";
                            }
                        } else {
                        }
                    }
                } else {
                    unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
                    return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">gagal ditambahkan</div>');
                    $success = false;
                    $message = "gagal ditambahkan";
                }
            }
        }else{
            $success = false;
            $message = "File media rusak";
        }
        $response["success"] = $success;
        $response["message"] = $message;
        echo json_encode($response);
    }
    private function _getIdCat($kategori)
    {
        $query = $this->db->get_where('kategori_file', ['kategori_file' => $kategori]);
        return $query->row();
    }
}
