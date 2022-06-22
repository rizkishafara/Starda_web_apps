<?php
class m_stakeholder extends CI_Model
{
    public function getAllStakeholders(){
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
		$this->db->where('status=', 'active');
		$this->db->where('gender!=', 'null');
        return $this->db->get();
    }
    public function getKaryaStakeholder($id)
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('kategori_file.*');
        $this->db->select('category_file.*');
        $this->db->select('user_kegiatan.*');
        $this->db->from('user_produk');
        $this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$this->db->join('category_file', 'category_file.id_cat_file = user_produk.id_cat_file', 'left');
		$this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$this->db->join('user_kegiatan', 'user_kegiatan.produk_id = user_produk.id_produk','left');
		$this->db->where('user_produk.status_produk=', '2');
		$this->db->where('user_produk.id_user=', $id);
        return $this->db->get();
    }

    public function getDokumenKarya($id)
    {
        $this->db->select('*');
        $this->db->from('user_product_document');
        $this->db->join('category_file', 'category_file.id_cat_file = user_product_document.id_cat_doc');
		$this->db->where('user_product_document.produk_id=', $id);
        return $this->db->get();
    }

    public function getUserKeyword($keyword)
	{
		$this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
		$this->db->where('status', 'active');
		$this->db->where('gender !=', '');
		$this->db->like('fullname', $keyword);
		$this->db->or_like('category_user', $keyword);
		return $this->db->get();
	}
}