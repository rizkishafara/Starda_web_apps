<?php
class m_document extends CI_Model
{

    public function document($id)
    {
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->join('user_data', 'user_document.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_document.status_doc=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_document.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->join('alasan_document', 'user_document.id_document=alasan_document.id_doc', 'left');
        $this->db->where('user_document.id_user', $id);
        return $this->db->get();
    }
    public function getDocument($id)
    {
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_document =' . $id);
        return $this->db->get();
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
            $this->desc_document = $post["desc_document"];
            $this->id_kategori = $post["kategori_file"];
            $this->upload_date = date("Y-m-d");

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Document berhasil ditambahkan</div>');
            return $this->db->insert("user_document", $this);
        }
    }
    public function editDocument($id)
    {
        $this->title_document = $this->input->post('title_document');
        $this->status_doc = "1";
        $this->desc_document = $this->input->post("desc_document");
        $this->id_kategori = $this->input->post("kategori_file");
        $this->upload_date = date("Y-m-d");
        if (!empty($_FILES["name_document"]["name"])) {
            $this->name_document = $this->_uploadDocument();
        } else {
            $this->name_document = $this->input->post('name_document1');
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Document berhasil diubah</div>');
        return $this->db->update('user_document', $this, array('id_document' => $id));
    }
    private function _uploadDocument()
    {
        $id_user = $this->session->userdata('id_user');
        $old_doc = $this->input->post('name_document1');

        $config['upload_path']          = 'storage/document_user';
        $config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
        $random_code = random_string('alnum', 15);
        $config['file_name'] = $id_user . '_doc' . $random_code;
        $config['overwrite']            = true;
        $config['max_size']             = 10240;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('name_document')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document tidak memenuhi syarat</div>');
            redirect('member/document', $error);
        } else {
            $file = $this->upload->data();
            // echo $file;
            // die;

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

            unlink(FCPATH . '/storage/document_user/' . $old_doc);
            return $this->name_document = $file["file_name"];
        }
    }
}
