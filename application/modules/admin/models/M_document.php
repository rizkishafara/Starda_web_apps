<?php
class m_document extends CI_Model
{
    
    public function document()
    {
        $this->db->select('user_document.*');
        $this->db->select('user_data.fullname');
        $this->db->select('status.*');
        $this->db->select('kategori_file.*');
        $this->db->from('user_document');
        $this->db->join('user_data', 'user_document.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_document.status_doc=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_document.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->where('user_document.status_doc','2');
        // $this->db->join('category_file', 'user_document.id_cat_file=category_file.id_cat_file', 'left');
        return $this->db->get();
    }
    public function getDocument($id)
    {
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_document =' . $id);
        return $this->db->get();
    }
    public function docpending()
    {
        $this->db->select('user_document.*');
        $this->db->select('user_data.fullname');
        $this->db->select('status.*');
        $this->db->select('kategori_file.*');
        $this->db->from('user_document');
        $this->db->join('user_data', 'user_document.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_document.status_doc=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_document.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->where('user_document.status_doc','1');
        // $this->db->join('category_file', 'user_document.id_cat_file=category_file.id_cat_file', 'left');
        return $this->db->get();
    }
    public function doctolak()
    {
        $this->db->select('user_document.*');
        $this->db->select('user_data.fullname');
        $this->db->select('status.*');
        $this->db->select('kategori_file.*');
        $this->db->select('alasan_document.*');
        $this->db->from('user_document');
        $this->db->join('user_data', 'user_document.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_document.status_doc=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_document.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->join('alasan_document', 'user_document.id_document=alasan_document.id_doc', 'left');
        $this->db->where('user_document.status_doc','3');
        // $this->db->join('category_file', 'user_document.id_cat_file=category_file.id_cat_file', 'left');
        return $this->db->get();
    }
}
