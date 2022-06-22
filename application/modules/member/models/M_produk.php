<?php
require('./application/third_party/php-ffmpeg/vendor/autoload.php');

class m_produk extends CI_Model
{

    public function produk($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk', '2');
        $this->db->where('user_produk.id_user', $id);
        return $this->db->get();
    }
    public function getProduk($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->where('id_produk =' . $id);
        return $this->db->get();
    }
    public function addProduk($id_user)
    {
        $random_code = random_string('alnum', 15);

        if (!empty($_FILES['produk']) && !empty($_FILES['doc_produk'])) {
            $config['upload_path']          = 'storage/media_user';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv|mpeg';
            $random_code = random_string('alnum', 15);
            $config['file_name'] = $id_user . '_produk' . $random_code;
            $config['overwrite']            = true;
            $config['encrypt_name']         = False;
            $config['max_size']             = 102400;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('produk')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk tidak memenuhi syarat</div>');
                redirect('member/produk', $error);
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
                    return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk gagal ditambahkan</div>');
                }
                $post = $this->input->post();
                $this->name_produk = $file["file_name"];
                $this->id_user = $id_user;
                $this->title_produk = $post["title_produk"];
                $this->desc_produk = $post["desc_produk"];
                $this->id_kategori = $post["kategori_file"];
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
                // $data=$this->tanggal_kegiatan = $post["tgl_kegiatan"];

                $this->db->insert("user_kegiatan", $data);

                // $id_produk = $this->_getIdProduk($filename);

                if (!empty($_FILES['doc_produk'])) {


                    $data = [];

                    $jumlah_doc = count($_FILES['doc_produk']['name']);
                    // var_dump($jumlah_doc);die;
                    for ($i = 0; $i < $jumlah_doc; $i++) {


                        if (!empty($_FILES['doc_produk']['name'][$i])) {

                            $_FILES['file']['name'] = $_FILES['doc_produk']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['doc_produk']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['doc_produk']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['doc_produk']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['doc_produk']['size'][$i];

                            $config['upload_path']          = 'storage/doc_media_user';
                            $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
                            $config['overwrite']            = true;
                            $random_code                    = random_string('alnum', 5);
                            $config['file_name']            = $random_code . $_FILES['doc_produk']['name'][$i];
                            $config['encrypt_name']         = False;
                            $config['max_size']             = 10400;

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);


                            if (!$this->upload->do_upload('file')) {
                                $error = array('error' => $this->upload->display_errors());
                                return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Dokumen tidak memenuhi syarat</div>');
                                redirect('member/produk/produk_pending', $error);
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
                            }
                        } else {
                        }
                    }
                } else {
                    unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
                    return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">gagal ditambahkan</div>');
                }
            }
        }
    }
    // private function _addProduk($id_user, $file)
    // {
    //     $fl = new SplFileInfo($file["file_name"]);
    //     $ext = $fl->getExtension();

    //     if ($ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
    //         $this->id_cat_file = "2";
    //     } else if ($ext == "mp4" or $ext  == "mkv") {
    //         $this->id_cat_file = "1";
    //     } else {
    //         unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
    //         return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk gagal ditambahkan</div>');
    //     }
    //     $post = $this->input->post();
    //     $this->name_produk = $file["file_name"];
    //     $this->id_user = $id_user;
    //     $this->title_produk = $post["title_produk"];
    //     $this->desc_produk = $post["desc_produk"];
    //     $this->id_kategori = $post["kategori_file"];
    //     $this->upload_date = date("Y-m-d");

    //     return $this->db->insert("user_produk", $this);
    // }
    // private function _addDocProduk($id_prod)
    // {
    // }
    public function editProduk($id)
    {
        $this->title_produk = $this->input->post('title_produk');
        $this->status_produk = "1";
        $this->desc_produk = $this->input->post("desc_produk");

        $data = array(
            'produk_id' => $id,
            'kegiatan' => $this->input->post("kegiatan"),
            'tanggal_kegiatan' => $this->input->post("tgl_kegiatan")
        );
        $kegiatan = $this->db->get_where('user_kegiatan', ['produk_id' => $id])->row();
        // var_dump($kegiatan);die;
        if ($kegiatan == null){
            $this->db->insert('user_kegiatan',$data);
        }else{
            $this->db->where('produk_id', $id);
            $this->db->update('user_kegiatan',$data);
        }

        $this->id_kategori = $this->input->post("kategori_file");
        $this->upload_date = date("Y-m-d");
        if (!empty($_FILES["name_produk"]["name"])) {
            $this->name_produk = $this->_uploadProduk();
        } else {
            $this->name_produk = $this->input->post('name_produk1');
        }
        $this->db->where('id_product', $id);
        $this->db->delete('alasan_produk');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Produk berhasil diubah</div>');
        return $this->db->update('user_produk', $this, array('id_produk' => $id));
    }
    private function _uploadProduk()
    {
        $id_user = $this->session->userdata('id_user');
        $old_produk = $this->input->post('name_produk1');

        $config['upload_path']          = 'storage/media_user';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv|mpeg';
        $random_code = random_string('alnum', 15);
        $config['file_name'] = $id_user . '_produk' . $random_code;
        $config['overwrite']            = true;
        $config['max_size']             = 102400;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('name_produk')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk tidak memenuhi syarat</div>');
            redirect('member/produk/produk_pending', $error);
        } else {
            $file = $this->upload->data();
            $fl = new SplFileInfo($file["file_name"]);
            $ext = $fl->getExtension();

            if ($ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
                $this->id_cat_file = "2";
            } else if ($ext == "mp4" or $ext  == "mkv") {
                $this->id_cat_file = "1";
            } else {
                return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk gagal ditambahkan</div>');
            }
            unlink(FCPATH . '/storage/media_user/' . $old_produk);
            return $this->name_produk = $file["file_name"];
        }
    }
    public function detailProduk($idproduk)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('user_kegiatan', 'user_produk.id_produk=user_kegiatan.produk_id', 'left');
        // $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.id_produk', $idproduk);
        return $this->db->get();
    }
    public function docPelengkap($idproduk)
    {
        $this->db->select('*');
        $this->db->from('user_product_document');
        $this->db->join('user_produk', 'user_produk.id_produk=user_product_document.produk_id', 'left');
        $this->db->where('user_product_document.produk_id', $idproduk);
        return $this->db->get();
    }
    public function produkPending($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk', '1');
        $this->db->where('user_produk.id_user', $id);
        return $this->db->get();
    }
    public function produkTolak($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk', '3');
        $this->db->where('user_produk.id_user', $id);
        return $this->db->get();
    }
    public function editDokumen($id, $id_produk)
    {
        if (!empty($_FILES["name_dokumen"]["name"])) {
            $this->name_document = $this->_uploadDokumen($id_produk);

            $this->db->where('id_product', $id_produk);
            $this->db->delete('alasan_produk');
            // $data=$this->status_produk = "1";
            $data['status_produk'] = "1";
            $this->db->where('id_produk', $id_produk);
            $this->db->update('user_produk', $data);

            $old_produk = $this->input->post('old_doc');
            unlink(FCPATH . '/storage/doc_media_user/' . $old_produk);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Dokumen berhasil diubah, unggahan anda akan ditinjau ulang oleh admin</div>');
        } else {
            redirect('member/produk/detail_produk/' . $id_produk);
        }


        return $this->db->update('user_product_document', $this, array('id_document' => $id));
    }
    private function _uploadDokumen($id_produk)
    {

        $config['upload_path']          = 'storage/doc_media_user';
        $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
        $config['overwrite']            = true;
        $random_code                    = random_string('alnum', 5);
        $config['file_name']            = $random_code . $_FILES['name_dokumen']['name'];
        $config['encrypt_name']         = False;
        $config['max_size']             = 10400;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('name_dokumen')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Dokumen tidak memenuhi syarat</div>');
            redirect('member/produk/detail_produk/' . $id_produk, $error);
        } else {
            $file = $this->upload->data();
            $fl = new SplFileInfo($file["file_name"]);
            $extdoc = $fl->getExtension();

            if ($extdoc == "doc" or $extdoc  == "docx") {
                $this->id_cat_doc = "3";
            } else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
                $this->id_cat_doc = "4";
            } else if ($extdoc == "pdf") {
                $this->id_cat_doc = "5";
            } else {
                unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Ekstensi dokumen tidak memenuhi syarat</div>');
                redirect('member/produk/detail_produk/' . $id_produk);
            }
            return $this->name_document = $file["file_name"];
        }
    }
    public function addDokumen($id_produk)
    {
        if (!empty($_FILES["name_dokumen"]["name"])) {
            $this->name_document = $this->_uploadDokumen($id_produk);

            $this->db->where('id_product', $id_produk);
            $this->db->delete('alasan_produk');
            // $data=$this->status_produk = "1";
            $data['status_produk'] = "1";
            $this->db->where('id_produk', $id_produk);
            $this->db->update('user_produk', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Dokumen berhasil diubah, unggahan anda akan ditinjau ulang oleh admin</div>');
        } else {
            redirect('member/produk/detail_produk/' . $id_produk);
        }

        $this->produk_id = $id_produk;
        return $this->db->insert('user_product_document', $this);
    }
    public function getKegiatan()
    {
        $sql = "SELECT DISTINCT kegiatan FROM user_kegiatan WHERE kegiatan IS NOT NULL GROUP BY kegiatan";
        return $this->db->query($sql);
    }
}
