<?php
class m_kegiatan extends CI_Model
{
    public function kegiatan()
    {
        $this->db->select('*');
        $this->db->from('daftar_kegiatan');
        return $this->db->get();
    }
    public function addCategory()
    {
        $data = [
            'kegiatan' => $this->input->post('kegiatan')

        ];

        $this->db->insert('daftar_kegiatan', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil ditambahkan</div>');
    }
    public function editCategory($id)
    {
        $this->kegiatan = $this->input->post('kegiatan');
        $this->db->update('daftar_kegiatan', $this, array('id_kegiatan' => $id));
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil diubah</div>');
    }
}