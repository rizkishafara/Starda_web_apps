<?php
class m_profile extends CI_Model
{
    public function editProfile()
    {
        $post = $this->input->post();
        $this->fullname = $post["fullname"];
        $this->email = $post["email"];
        $this->address_user = $post["address_user"];
        $this->phone_user = $post["phone_user"];
        $this->id_category = $post["category"];
        $this->gender = $post["gender"];
        $this->about = $post["about"];

        return $this->db->update("user_data", $this, array('id_user' => $this->session->userdata('id_user')));
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

    // public function addMedia($id_user)
    // {
    //     $post = $this->input->post();
    //     $this->id_user = $id_user;
    //     $this->title_media = $post["title_media"];
    //     $this->name_media = $this->_mediaUsers($id_user);

    //     return $this->db->insert("user_media", $this);
    // }
    public function addMedia($id_user)
    {

        $config['upload_path']          = 'storage/media_user';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv';
        $random_code = random_string('alnum', 15);
        $config['file_name'] = $id_user . '_media' . $random_code;
        $config['overwrite']            = true;
        $config['max_size']             = 102400;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('media')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Media tidak memenuhi syarat</div>');
            redirect('profile', $error);
        } else {
            $post = $this->input->post();
            $file = $this->upload->data();
            $fl = new SplFileInfo($file["file_name"]);
            $ext = $fl->getExtension();

            if ($ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
                $this->id_cat_file = "2";
            } else if ($ext == "mp4" or $ext  == "mkv") {
                $this->id_cat_file = "1";
            } else {
                return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Media gagal ditambahkan</div>');
            }

            $this->id_user = $id_user;
            $this->title_media = $post["title_media"];
            $this->name_media = $file["file_name"];

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Media berhasil ditambahkan</div>');
            return $this->db->insert("user_media", $this);
        }
    }
    public function addDocument($id_user)
    {

        $config['upload_path']          = 'storage/document_user';
        $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
        $random_code = random_string('alnum', 15);
        $config['file_name'] = $id_user . '_doc' . $random_code;
        $config['overwrite']            = true;
        $config['max_size']             = 10240;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('document')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document tidak memenuhi syarat</div>');
            redirect('profile', $error);
        } else {
            $post = $this->input->post();
            $file = $this->upload->data();

            $ext = pathinfo($file["file_name"], PATHINFO_EXTENSION);
         

            if ($ext == "doc" or $ext  == "docx") {
                $this->id_cat_file = "3";
            } else if ($ext == "csv" or $ext  == "xls" or $ext  == "xlsx") {
                $this->id_cat_file = "4";
            } else if ($ext == "pdf") {
                $this->id_cat_file = "5";
            } else {
                return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document gagal ditambahkan</div>');
            }

            $this->id_user = $id_user;
            $this->title_document = $post["title_document"];
            $this->name_document = $file["file_name"];

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Document berhasil ditambahkan</div>');
            return $this->db->insert("user_document", $this);
        }
    }
}
