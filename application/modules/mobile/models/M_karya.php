<?php
class m_karya extends CI_Model
{
    public function getAllKarya()
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
        return $this->db->get();
	}
    public function getKarya($keyword)
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
		$this->db->where('user_produk.status_produk', '2');
		$this->db->like('title_produk', $keyword);
		$this->db->or_like('kategori_file', $keyword);
		$this->db->where('user_produk.status_produk', '2');
		return $this->db->get();
	}
}