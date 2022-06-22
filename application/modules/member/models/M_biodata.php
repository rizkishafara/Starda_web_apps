<?php
class m_biodata extends CI_Model
{
    public function biodata($id)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user', 'left');
        $this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
        $this->db->where('user_data.id_user', $id);
        return $this->db->get();
    }
    public function getCategory()
    {
        $this->db->select('*');
        $this->db->from('user_kategori');
        return $this->db->get();
    }
    public function getSubcategory()
    {
        $this->db->select('*');
        $this->db->from('sub_kategori');
        $this->db->join('kategori', 'kategori.id_cat=sub_kategori.category_id', 'left');
        return $this->db->get();
    }
    public function getKeahlian()
    {
        $this->db->select('*');
        $this->db->from('user_keahlian');
        return $this->db->get();
    }

    public function editPhoto($id_user)
    {
        $post = $this->input->post();
        if (!empty($_FILES["photo_user"]["name"])) {
            $this->photo_user = $this->_imageProfile($id_user);
            return $this->db->update('user_data', $this, array('id_user' => $id_user));
        } else {
            $this->photo_user = $post["photo_user1"];
        }
    }
    private function _imageProfile($id_user)
    {
        $config['upload_path']          = 'storage/profile_user';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['overwrite']            = true;
        $config['max_size']             = 10240;

        $random_code = random_string('alnum', 15);
        $config['file_name'] = $id_user . '_' . $random_code;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $old_image = $this->input->post('photo_user1');

        if ($this->upload->do_upload('photo_user')) {
            if ($old_image != 'default.png') {
                unlink(FCPATH . '/storage/profile_user/' . $old_image);
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Foto berhasil diganti</div>');
            return $this->upload->data("file_name");
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Foto tidak memenuhi syarat</div>');
        }

        return $old_image;
    }

    public function saveBio($id)
    {
        $post = $this->input->post();
        $this->fullname = $post["fullname"];
        $this->address_user = $post["address"];
        $this->phone_user = "62" . $post["phone"];
        $this->id_category_user = $post["category"];
        $this->id_keahlian_user = $post["keahlian"];
        // $this->id_sub_category = $post["subcategory"];

        // // get id with sql
        // $idsubcat=$post["subcategory"];
        // $subcat=$this->_getIdcat($idsubcat)->row();

        // // convert id to string
        // $this->id_category = $subcat->category_id;

        $this->gender = $post["gender"];
        $this->about = $post["about"];
        $this->instansi = $post["instansi"];

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Biodata berhasil diubah</div>');
        return $this->db->update("user_data", $this, array('id_user' => $id));
    }
    private function _getIdcat($idsubcat)
    {
        $this->db->select('category_id');
        $this->db->from('sub_kategori');
        $this->db->where('id_sub_category', $idsubcat);
        return $this->db->get();
    }
}
