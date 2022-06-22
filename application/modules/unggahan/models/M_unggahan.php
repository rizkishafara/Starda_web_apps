<?php
class m_unggahan extends CI_Model
{

	public function tampil_unggahan()
	{
		$this->db->select('*');
		$this->db->from('user_produk');
		$this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$this->db->where('user_produk.status_produk', '2');
		return $this->db->get();
	}
	public function tampil_search($keyword)
	{
		$this->db->select('*');
		$this->db->from('user_produk');
		$this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$this->db->where('user_produk.status_produk', '2');
		$this->db->like('title_produk', $keyword);
		$this->db->or_like('kategori_file', $keyword);
		$this->db->where('user_produk.status_produk', '2');
		return $this->db->get();
	}
	public function tampil_data($id)
	{
		$this->db->select("*");
		$this->db->from("user_produk");
		$this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		// $this->db->join('user_produk', 'user_produk.id_user = user_data.id_user');
		// $this->db->join('user_document', 'user_document.id_user = user_data.id_user');
		$this->db->where("user_produk.id_produk=" . $id);
		return $this->db->get()->row();
	}

	public function tampil_gallery($id)
	{
		$this->db->select('*');
		$this->db->from('user_produk');
		$this->db->where('id_user =' . $id);
		$this->db->where('user_produk.status_produk ', '2');
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
		$user_data = $this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$kategori = $this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$status = $this->db->where('user_produk.status_produk', '2');
		// $this->db->get()->result();
		return $this->db->get('user_produk', $limit, $start, $kategori, $user_data, $status)->result();
	}
	function countUnduh($id)
	{
		$this->db->get_where('unduh_produk', ['id_user' => $id])->num_rows();
	}
	function dataSearch($limit, $start, $keyword)
	{
		// $this->db->select('*');	
		// $this->db->from('user_data', $limit, $start);
		$user_data = $this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$kategori = $this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$status = $this->db->where('user_produk.status_produk', '2');
		$katakunci = $this->db->like('name_produk', $keyword);
		$katakunci = $this->db->or_like('kategori_file', $keyword);
		// $this->db->get()->result();
		return $this->db->get('user_produk', $limit, $start, $kategori, $user_data, $status, $katakunci)->result();
	}
	public function get_produk_keyword($keyword)
	{
		$this->db->select('*');
		$this->db->from('user_produk');
		$this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$this->db->where('user_produk.status_produk', '2');
		$this->db->like('user_produk.title_produk', $keyword);
		$this->db->or_like('kategori_file.kategori_file', $keyword);
		$this->db->or_like('user_produk.desc_produk', $keyword);
		return $this->db->get();
	}
	public function getCategory()
	{
		$this->db->select('*');
		$this->db->from('kategori_file');
		return $this->db->get();
	}
	public  function getUserId($id)
	{
		$this->db->select('*');
		$this->db->from('user_produk');
		$this->db->join('user_data', 'user_data.id_user = user_produk.id_user');
		$this->db->join('kategori_file', 'kategori_file.id_kategori_file = user_produk.id_kategori');
		$this->db->where('user_produk.status_produk', '2');
		$this->db->where('user_produk.id_kategori', $id);
		return $this->db->get();
	}
}
