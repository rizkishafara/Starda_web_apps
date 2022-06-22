<?php
class m_usermember extends CI_Model
{
    public function usermember()
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
        $this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
        $this->db->where('status', 'active');
        return $this->db->get();
    }

    // public function resetpassMember($id)
    // {
    //     $this->status ='non active';

    //     $this->db->update('user_data', $this, array('id_user' => $id));
    //     $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil ditambahkan</div>');
    // }


    // public function getusermember($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('user_data');
    //     $this->db->join('kategori', 'kategori.id_category = user_data.id_category');
    //     $this->db->where('id_user', $id);
    //     return $this->db->get();
    // }
    public function tampil_document($id)
    {
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_user =' . $id);
        return $this->db->get();
    }
    public function deleteMember($id)
    {
        // delete profile
        $profile = $this->db->get_where('user_data', ['id_user' => $id])->row();
        unlink(FCPATH . 'storage/profile_user/' . $profile->photo_user);

        // delete user on table
        $this->db->where('id_user', $id);
        $this->db->delete('user_data');

        // delete media user
        $media = $this->db->get_where('user_produk', ['id_user' => $id])->result_array();

        foreach ($media as $m) {
            unlink(FCPATH . 'storage/media_user/' . $m['name_produk']);

            // delete document user
            $document = $this->db->get_where('user_product_document', ['produk_id' => $m['id_produk']])->result_array();
            foreach ($document as $doc) {
                unlink(FCPATH . 'storage/doc_media_user/' . $doc['name_document']);
            }
            $this->db->where('produk_id', $m['id_produk']);
            $this->db->delete('user_product_document');
        }
        $this->db->where('id_user', $id);
        $this->db->delete('user_produk');

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data berhasil dihapus</div>');
    }
}
