<?php
class m_categoryfile extends CI_Model
{
    public function categoryfile()
    {
        $this->db->select('*');
        $this->db->from('kategori_file');
        return $this->db->get();
    }
    public function addCategoryFile()
    {
        $data = [
            'kategori_file' => $this->input->post('kategori_file')

        ];

        $this->db->insert('kategori_file', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil ditambahkan</div>');
    }
    public function editCategoryFile($id)
    {
        $this->kategori_file = $this->input->post('kategori_file');
        $this->db->update('kategori_file', $this, array('id_kategori_file' => $id));
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil diubah</div>');
    }
}
