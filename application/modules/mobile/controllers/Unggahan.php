<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unggahan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_unggahan');
        $this->load->model('m_stakeholder');
    }
    public function Unggahan_diterima($id)
    {
        $query = $this->m_unggahan->getKaryaDiterima($id)->result();
        echo json_encode($query);
    }
    public function Unggahan_ditinjau($id)
    {
        $query = $this->m_unggahan->getKaryaDitinjau($id)->result();
        echo json_encode($query);
    }
    public function Unggahan_ditolak($id)
    {
        $query = $this->m_unggahan->getKaryaDitolak($id)->result();
        echo json_encode($query);
    }
    public function Delete_unggahan()
    {
        $id = $this->input->post('id_produk');
        // delete file di storage
        $getDoc =  $this->m_stakeholder->getDokumenKarya($id)->result();
        foreach ($getDoc as $docGet) {
            $docproduk = $docGet->name_document;
            unlink(FCPATH . 'storage/doc_media_user/' . $docproduk);
        }
        $getUnggahan =  $this->m_unggahan->getKarya($id)->row_array();
        $produk = $getUnggahan['name_produk'];
        unlink(FCPATH . 'storage/media_user/' . $produk);

        $this->db->where('id_produk', $id);
        $this->db->delete('user_produk');

        $this->db->where('produk_id', $id);
        $this->db->delete('user_product_document');

        $this->db->where('id_product', $id);
        $this->db->delete('alasan_produk');

        $this->db->where('produk_id', $id);
        $this->db->delete('user_kegiatan');

        $success = true;
        $message = "Data berhasil dihapus";
        $response["success"] = $success;
        $response["message"] = $message;
        echo json_encode($response);
    }
    public function Edit_unggahan()
    {
        $id = $this->input->post('id_produk');
        $kategori = $this->input->post('kategori');
        $kat = $this->m_unggahan->getIdCat($kategori);
        // var_dump($kategori);die;

        $this->title_produk = $this->input->post('judul');
        $this->status_produk = "1";
        $this->desc_produk = $this->input->post("deskripsi");
        $this->id_kategori = $kat->id_kategori_file;

        $this->upload_date = date("Y-m-d");

        
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
            $this->name_produk = $file["file_name"];
        }


        
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

        $this->db->where('id_product', $id);
        $this->db->delete('alasan_produk');
        // $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Produk berhasil diubah</div>');
        $this->db->update('user_produk', $this, array('id_produk' => $id));
        $response["success"] = true;
        $response["message"] = "Data berhasil diubah";
        echo json_encode($response);
    }
    public function Edit_dokumen()
    {
        $id_dokumen = $this->input->post('id_dokumen');
        $id_prod = $this->db->get_where('user_product_document', ['id_document' => $id_dokumen])->row();
        // var_dump($id_prod);die;
		$id_produk = $id_prod->produk_id;
		$this->m_unggahan->editDokumen($id_dokumen, $id_produk);
    }
}
