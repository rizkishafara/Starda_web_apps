<?php
class m_category extends CI_Model
{
    public function category()
    {
        $this->db->select('*');
        $this->db->from('user_kategori');
        return $this->db->get();
    }
    public function addCategory()
    {
        $data = [
            'category_user' => $this->input->post('category')

        ];

        $this->db->insert('user_kategori', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil ditambahkan</div>');
    }
    public function editCategory($id)
    {
        $this->category_user = $this->input->post('category');
        $this->db->update('user_kategori', $this, array('id_cat' => $id));
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil diubah</div>');
    }
    public function editSubcategory($id)
    {
        $this->category_id = $this->input->post('category');
        $this->sub_category = $this->input->post('subcategory');
        $this->db->update('sub_kategori', $this, array('id_sub_category' => $id));
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil diubah</div>');
    }
}