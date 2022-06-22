<?php
class m_keahlian extends CI_Model
{
    public function keahlian()
    {
        $this->db->select('*');
        $this->db->from('user_keahlian');
        return $this->db->get();
    }
    public function addCategory()
    {
        $data = [
            'keahlian_user' => $this->input->post('keahlian')

        ];

        $this->db->insert('user_keahlian', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil ditambahkan</div>');
    }
    public function editCategory($id)
    {
        $this->keahlian_user = $this->input->post('keahlian');
        $this->db->update('user_keahlian', $this, array('id_keahlian' => $id));
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil diubah</div>');
    }
}