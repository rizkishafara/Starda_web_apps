<?php
class m_useradmin extends CI_Model
{
    public function useradmin()
    {
        $this->db->select('*');
        $this->db->from('admin');
        return $this->db->get();
    }
    public function addAdmin()
    {
        $data = [
            'username_admin' => $this->input->post('username', true),
            'password_admin' => md5($this->input->post('password', true))

        ];

        $this->db->insert('admin', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil ditambahkan</div>');
    }
    public function editAdmin($id)
    {
        $this->username_admin = $this->input->post('username');
        $oldpass = $this->input->post('oldpass');
        if ($this->input->post('password') == $oldpass) {
            $this->password_admin = $oldpass;
        } else {
            $this->password_admin = md5($this->input->post('password'));
        }
        $this->db->update('admin', $this, array('id_admin' => $id));
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil diubah</div>');
    }
    // private function _getOldpass($id)
    // {
    //     $this->db->select('password_admin');
    //     $this->db->from('admin');
    //     $this->db->where('id_admin', $id);
    //     return $this->db->get();
    // }
}
