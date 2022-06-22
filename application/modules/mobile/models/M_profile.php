<?php
class m_profile extends CI_Model
{
    public function getDataUser($resultId)
    {
        
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_keahlian', 'user_keahlian.id_keahlian= user_data.id_keahlian_user');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
        $this->db->where('user_data.id_user =' . $resultId);
        return $this->db->get();
    }
    public function getIdCat($category)
    {
        $query = $this->db->get_where('user_kategori', ['category_user' => $category]);
        // $id = $query['id_cat'];
        // $id = $query->id_cat;
        // echo $id;
        return $query->row();
    }
    public function getIdKeahlian($keahlian)
    {
        $query = $this->db->get_where('user_keahlian', ['keahlian_user' => $keahlian]);
        return $query->row();
    }
    public function editPhoto($resultId){
        $response = array("error" => FALSE);
        
        $post = $this->input->post();
        if (!empty($_FILES["file"]["name"])) {
            $this->photo_user = $this->_imageProfile($resultId);
            $this->db->update('user_data', $this, array('id_user' => $resultId));

            $query = $this->getDataUser($resultId)->result_array();
            foreach ($query as $row) {
                $response["error"] = false;
                $response["user"]["id"] = $row['id_user'];
                $response["user"]["nama"] = $row['fullname'];
                $response["user"]["photo"] = $row['photo_user'];
                echo json_encode($response);
            }
        } else {
            // $this->photo_user = $post["photo_user1"];
            $response["error"] = true;
            $response["error_msg"] = "Gagal mengupdate foto!";
            echo json_encode($response);
        }
    }
    private function _imageProfile($resultId)
    {
        
        $config['upload_path']          = 'storage/profile_user';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['overwrite']            = true;
        $config['max_size']             = 10240;

        $random_code = random_string('alnum', 15);
        $config['file_name'] = $resultId . '_' . $random_code;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $get_oldimage = $this->getDataUser($resultId)->row_array();
        $old_image= $get_oldimage['photo_user'];
        // var_dump($old_image);die;


        if ($this->upload->do_upload('file')) {
            if ($old_image != 'default.png') {
                unlink(FCPATH . '/storage/profile_user/' . $old_image);
            }
            return $this->upload->data("file_name");
        } else {
            $response["error"] = true;
            $response["error_msg"] = "Foto tidak memenuhi syarat!";
            echo json_encode($response);
        }

        return $this->input->post($old_image);
    }
    
}
