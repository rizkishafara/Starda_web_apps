<?php
class m_media extends CI_Model
{

    public function media()
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('status.*');
        $this->db->select('kategori_file.*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->where('user_produk.status_produk', '2');
        return $this->db->get();
    }
    public function getMedia($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->where('id_produk =' . $id);
        return $this->db->get();
    }
    public function mediapending()
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('status.*');
        $this->db->select('kategori_file.*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->where('user_produk.status_produk', '1');

        // $this->db->join('category_file', 'user_produk.id_cat_file=category_file.id_cat_file', 'left');
        return $this->db->get();
    }
    public function mediatolak()
    {
        $this->db->select('user_produk.*');
        $this->db->select('user_data.fullname');
        $this->db->select('status.*');
        $this->db->select('kategori_file.*');
        $this->db->select('alasan_produk.*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.status_produk', '3');

        // $this->db->join('category_file', 'user_produk.id_cat_file=category_file.id_cat_file', 'left');
        return $this->db->get();
    }
    public function detailProduk($idproduk)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->join('user_data', 'user_produk.id_user=user_data.id_user', 'left');
        $this->db->join('status', 'user_produk.status_produk=status.id_status', 'left');
        $this->db->join('kategori_file', 'user_produk.id_kategori=kategori_file.id_kategori_file', 'left');
        // $this->db->join('alasan_produk', 'user_produk.id_produk=alasan_produk.id_product', 'left');
        $this->db->where('user_produk.id_produk', $idproduk);
        return $this->db->get();
    }
    public function docPelengkap($idproduk)
    {
        $this->db->select('*');
        $this->db->from('user_product_document');
        $this->db->where('user_product_document.produk_id', $idproduk);
        return $this->db->get();
    }
    public function kegiatanProduk($idproduk)
    {
        $sql = "SELECT DISTINCT kegiatan FROM user_kegiatan LEFT JOIN user_produk ON user_produk.id_produk=user_kegiatan.produk_id WHERE user_produk.id_produk=$idproduk";
		return $this->db->query($sql);
    }
}
