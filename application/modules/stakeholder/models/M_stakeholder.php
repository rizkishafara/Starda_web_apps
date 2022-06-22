<?php
class m_stakeholder extends CI_Model
{

	public function tampil_stakeholder()
	{
		$this->db->select('*');
		$this->db->from('user_data');
		$this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->where('status=', 'active');
		$this->db->where('gender!=', 'null');
		return $this->db->get();
	}
	public function tampil_search($keyword)
	{
		$this->db->select('*');
		$this->db->from('user_data');
		$this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->where('status=', 'active');
		$this->db->like('fullname', $keyword);
		$this->db->or_like('category_user', $keyword);
		$this->db->where('gender!=', 'null');
		return $this->db->get();
	}
	public function tampil_data($id)
	{
		$this->db->select("*");
		$this->db->from("user_data");
		$this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
		// $this->db->join('user_media', 'user_media.id_user = user_data.id_user');
		// $this->db->join('user_document', 'user_document.id_user = user_data.id_user');
		$this->db->where("user_data.id_user=" . $id);
		return $this->db->get()->row();
	}

	public function tampil_gallery($id)
	{
		$this->db->select('*');
		$this->db->from('user_produk');
		$this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori', 'left');
		$this->db->where('id_user =' . $id);
		$this->db->where('status_produk ', '2');
		return $this->db->get();
	}
	public function tampil_document($id)
	{
		$this->db->select('*');
		$this->db->from('user_document');
		$this->db->where('id_user =' . $id);
		$this->db->where('status_doc ', '2');
		return $this->db->get();
	}
	function data($limit, $start)
	{
		// $this->db->select('*');	
		// $this->db->from('user_data', $limit, $start);
		$kategori = $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$status = $this->db->where('status', 'active');
		$gender = $this->db->where('gender !=', '');
		// $this->db->get()->result();
		return $this->db->get('user_data', $limit, $start, $kategori, $status, $gender)->result();
	}
	function dataSearch($limit, $start, $keyword)
	{
		// $this->db->select('*');	
		// $this->db->from('user_data', $limit, $start);
		$kategori = $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$status = $this->db->where('status', 'active');
		$gender = $this->db->where('gender !=', '');
		$katakunci = $this->db->like('fullname', $keyword);
		$katakunci = $this->db->or_like('category_user', $keyword);
		return $this->db->get('user_data', $limit, $start, $kategori, $status, $gender, $katakunci)->result();
	}
	public function get_user_keyword($keyword)
	{
		$this->db->select("*");
		$this->db->from("user_data");
		$this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->where('status', 'active');
		$this->db->where('gender !=', '');
		$this->db->like('fullname', $keyword);
		$this->db->or_like('category_user', $keyword);
		return $this->db->get();
	}
	public function getCategory()
	{
		$this->db->select('*');
		$this->db->from('user_kategori');
		return $this->db->get();
	}
	public  function getUserId($id)
	{
		$this->db->select('*');
		$this->db->from('user_data');
		$this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
		$this->db->where('status', 'active');
		$this->db->where('gender !=', '');
		$this->db->where('user_data.id_category_user', $id);
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
	public function tampil_kegiatan($id)
	{
		$sql = "SELECT DISTINCT kegiatan, tanggal_kegiatan FROM user_kegiatan LEFT JOIN user_produk ON user_produk.id_produk=user_kegiatan.produk_id WHERE kegiatan IS NOT NULL AND user_produk.id_user=$id AND user_produk.status_produk=2";
		return $this->db->query($sql);

		// $this->db->distinct();
		// $this->db->select('kegiatan', 'tanggal_kegiatan');
		// $this->db->from('user_kegiatan');
		// $this->db->join('user_produk', 'user_produk.id_produk=user_kegiatan.produk_id', 'left');
		// $this->db->where('user_produk.id_user', $id);
		// return $this->db->get();

	}
	public function produkKegiatan($idproduk)
	{
		$sql = "SELECT DISTINCT kegiatan FROM user_kegiatan LEFT JOIN user_produk ON user_produk.id_produk=user_kegiatan.produk_id WHERE user_produk.id_produk=$idproduk";
		return $this->db->query($sql);

		// $this->db->distinct();
		// $this->db->select('kegiatan', 'tanggal_kegiatan');
		// $this->db->from('user_kegiatan');
		// $this->db->join('user_produk', 'user_produk.id_produk=user_kegiatan.produk_id', 'left');
		// $this->db->where('user_produk.id_user', $id);
		// return $this->db->get();

	}
	
	public function docPelengkap($idproduk)
	{
		$this->db->select('*');
		$this->db->from('user_product_document');
		$this->db->where('user_product_document.produk_id', $idproduk);
		return $this->db->get();
	}
}
