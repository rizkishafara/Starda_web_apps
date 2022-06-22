<?php
require('./application/third_party/php-ffmpeg/vendor/autoload.php');

class m_unggahan extends CI_Model
{
    public function getKaryaDiterima($id)
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('kategori_file.*');
        $this->db->select('category_file.*');
        $this->db->select('user_kegiatan.*');
        $this->db->select('status.status');
        $this->db->select('alasan_produk.alasan');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
        $this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori', 'left');
        $this->db->join('category_file', 'category_file.id_cat_file = user_produk.id_cat_file', 'left');
        $this->db->join('user_kegiatan', 'user_kegiatan.produk_id = user_produk.id_produk', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk=', '2');
        $this->db->where('user_produk.id_user=', $id);
        return $this->db->get();
    }
    public function getKaryaDitinjau($id)
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('kategori_file.*');
        $this->db->select('category_file.*');
        $this->db->select('user_kegiatan.*');
        $this->db->select('status.status');
        $this->db->select('alasan_produk.alasan');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
        $this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori', 'left');
        $this->db->join('category_file', 'category_file.id_cat_file = user_produk.id_cat_file', 'left');
        $this->db->join('user_kegiatan', 'user_kegiatan.produk_id = user_produk.id_produk', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk=', '1');
        $this->db->where('user_produk.id_user=', $id);
        return $this->db->get();
    }
    public function getKaryaDitolak($id)
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('kategori_file.*');
        $this->db->select('category_file.*');
        $this->db->select('user_kegiatan.*');
        $this->db->select('status.status');
        $this->db->select('alasan_produk.alasan');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
        $this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori', 'left');
        $this->db->join('category_file', 'category_file.id_cat_file = user_produk.id_cat_file', 'left');
        $this->db->join('user_kegiatan', 'user_kegiatan.produk_id = user_produk.id_produk', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk=', '3');
        $this->db->where('user_produk.id_user=', $id);
        return $this->db->get();
    }
    public function getKarya($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->where('id_produk =' . $id);
        return $this->db->get();
    }
    public function editUnggahan($id)
    {
        $id_user = $this->input->post('id_user');
        $old_produk = $this->input->post('file_lama');

        $config['upload_path']          = 'storage/media_user';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv|mpeg';
        $random_code = random_string('alnum', 15);
        $config['file_name'] = $id_user . '_produk' . $random_code;
        $config['overwrite']            = true;
        $config['max_size']             = 102400;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            // $error = array('error' => $this->upload->display_errors());
            // $response["success"] = false;
            // $response["message"] = "Produk tidak memenuhi syarat";
            // echo json_encode($response);
            // die;
            return $this->name_produk = $this->input->post('file_lama');
        } else {
            $file = $this->upload->data();
            $fl = new SplFileInfo($file["file_name"]);
            $ext = $fl->getExtension();
            if ($ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
                $id_cat_file = "2";
            } else if ($ext == "mp4" or $ext  == "mkv") {
                $id_cat_file = "1";
            } else {
                $id_cat_file = "0";
                $response["success"] = false;
                $response["message"] = "Jenis file tidak sesuai";
                echo json_encode($response);
                die;
            }
            unlink(FCPATH . '/storage/media_user/' . $old_produk);
            $this->id_cat_file = $id_cat_file;
            // var_dump($id_cat_file);die;
            return $this->name_produk = $file["file_name"];
        }
    }
    public function getIdCat($kategori)
    {
        $query = $this->db->get_where('kategori_file', ['kategori_file' => $kategori]);
        return $query->row();
    }



    public function editDokumen($id, $id_produk)
    {
        $getOldDokumen = $this->db->get_where('user_product_document', ['id_document' => $id])->row();
		$oldDok = $getOldDokumen->name_document;

        if (!empty($_FILES["fileDoc"]["name"])) {
            $this->_uploadDokumen();

            $this->db->where('id_product', $id_produk);
            $this->db->delete('alasan_produk');
            // $data=$this->status_produk = "1";
            $data['status_produk'] = "1";
            $this->db->where('id_produk', $id_produk);
            $this->db->update('user_produk', $data);

            unlink(FCPATH . '/storage/doc_media_user/' . $oldDok);

            $response["success"] = true;
            $response["message"] = "Dokumen berhasil diubah, unggahan anda akan ditinjau ulang oleh admin";
        } else {
            $response["success"] = false;
            $response["message"] = "Anda belum memilih dokumen";
        }


        $this->db->update('user_product_document', $this, array('id_document' => $id));
        echo json_encode($response);die;
    }
    private function _uploadDokumen()
    {

        $config['upload_path']          = 'storage/doc_media_user';
        $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
        $config['overwrite']            = true;
        $random_code                    = random_string('alnum', 5);
        $config['file_name']            = $random_code . $_FILES['fileDoc']['name'];
        $config['encrypt_name']         = False;
        $config['max_size']             = 10400;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('fileDoc')) {
            $response["success"] = false;
            $response["message"] = "Dokumen tidak memenuhi syarat";
            echo json_encode($response);die;
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

                $response["success"] = false;
                $response["message"] = "Ekstensi dokumen tidak memenuhi syarat";
                echo json_encode($response);die;
            }
            $this->name_document = $file["file_name"];
        }
    }
}
