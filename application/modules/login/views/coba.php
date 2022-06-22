<?php
if (!empty($_FILES['produk'])) {
	$config['upload_path']          = 'storage/media_user';
	$config['allowed_types']        = 'gif|jpg|png|jpeg|mp4|mkv|mpeg';
	$random_code = random_string('alnum', 15);
	$config['file_name'] = $id_user . '_produk' . $random_code;
	$config['overwrite']            = true;
	$config['encrypt_name']         = False;
	$config['max_size']             = 102400;

	$this->upload->initialize($config);

	if (!$this->upload->do_upload('produk')) {
		$error = array('error' => $this->upload->display_errors());
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk tidak memenuhi syarat</div>');
		redirect('member/produk', $error);
	} else {
		$file = $this->upload->data();

		$fl = new SplFileInfo($file["file_name"]);
		$ext = $fl->getExtension();

		if ($ext == "JPG" or $ext == "jpg" or $ext  == "png" or $ext == "jpeg" or $ext == "gif") {
			$this->id_cat_file = "2";
		} else if ($ext == "mp4" or $ext  == "mkv") {
			$this->id_cat_file = "1";
		} else {
			unlink(FCPATH . '/storage/media_user/' . $file["file_name"]);
			return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Produk gagal ditambahkan</div>');
		}
		$post = $this->input->post();
		$this->name_produk = $file["file_name"];
		$this->id_user = $id_user;
		$this->title_produk = $post["title_produk"];
		$this->desc_produk = $post["desc_produk"];
		$this->id_kategori = $post["kategori_file"];
		$this->upload_date = date("Y-m-d");

		$this->db->insert("user_produk", $this);

		$id_produk = $this->db->get_where('user_produk', ['name_produk' => $file['file_name']])->row();
		$id_prod = $id_produk->id_produk;

		if (!empty($_FILES['doc_produk1'])) {
			$this->_addDocProduk1($id_prod);
		}
		if (!empty($_FILES['doc_produk2'])) {
			$this->_addDocProduk2($id_prod);
		}
		if (!empty($_FILES['doc_produk3'])) {
			$this->_addDocProduk3($id_prod);
		}
	}
} else {
	$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Dokumen pelengkap masih kosong</div>');
	redirect('member/produk');
}
}

private function _addDocProduk1($id_prod)
{
$config['upload_path']          = 'storage/doc_media_user';
$config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
$random_code                    = random_string('alnum', 5);
$config['file_name']            = $random_code.$_FILES["doc_produk1"]['name'];
$config['overwrite']            = true;
$config['encrypt_name']         = False;
$config['max_size']             = 10400;

// $this->load->library('upload', $config);
$this->upload->initialize($config);

if (!$this->upload->do_upload('doc_produk1')) {
	$error = array('error' => $this->upload->display_errors());
	return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Dokumen 1 tidak memenuhi syarat</div>');
	redirect('member/produk', $error);
} else {
	$file = $this->upload->data();
	$fl = new SplFileInfo($file["file_name"]);
	$extdoc = $fl->getExtension();

	if ($extdoc == "doc" or $extdoc  == "docx") {
		$data['id_cat_file'] = "3";
	} else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
		$data['id_cat_file'] = "4";
	} else if ($extdoc == "pdf") {
		$data['id_cat_file'] = "5";
	} else {
		unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
		return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document gagal ditambahkan</div>');
	}
	$data['produk_id'] = $id_prod;
	$data['name_document'] = $file["file_name"];
	return $this->db->insert('user_product_document', $data);
}
}
private function _addDocProduk2($id_prod)
{
$config['upload_path']          = 'storage/doc_media_user';
$config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
$random_code                    = random_string('alnum', 5);
$config['file_name']            = $random_code.$_FILES["doc_produk2"]['name'];
$config['overwrite']            = true;
$config['encrypt_name']         = False;
$config['max_size']             = 10400;

$this->load->library('upload', $config);
// $this->upload->initialize($config);

if (!$this->upload->do_upload('doc_produk2')) {
	$error = array('error' => $this->upload->display_errors());
	return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Dokumen 2 tidak memenuhi syarat</div>');
	redirect('member/produk', $error);
} else {
	$file = $this->upload->data();
	$fl = new SplFileInfo($file["file_name"]);
	$extdoc = $fl->getExtension();

	if ($extdoc == "doc" or $extdoc  == "docx") {
		$data2['id_cat_file'] = "3";
	} else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
		$data2['id_cat_file'] = "4";
	} else if ($extdoc == "pdf") {
		$data2['id_cat_file'] = "5";
	} else {
		unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
		return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document gagal ditambahkan</div>');
	}
	$data2['produk_id'] = $id_prod;
	$data2['name_document'] = $file["file_name"];
	return $this->db->insert('user_product_document', $data2);
}
}
private function _addDocProduk3($id_prod)
{
$config['upload_path']          = 'storage/doc_media_user';
$config['allowed_types']        = 'doc|docx|pdf|csv|xls|xlsx';
$random_code                    = random_string('alnum', 5);
$config['file_name']            = $random_code.$_FILES["doc_produk3"]['name'];
$config['overwrite']            = true;
$config['encrypt_name']         = False;
$config['max_size']             = 10400;

$this->load->library('upload', $config);
// $this->upload->initialize($config);

if (!$this->upload->do_upload('doc_produk3')) {
	$error = array('error' => $this->upload->display_errors());
	return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Dokumen 3 tidak memenuhi syarat</div>');
	redirect('member/produk', $error);
} else {
	$file = $this->upload->data();
	$fl = new SplFileInfo($file["file_name"]);
	$extdoc = $fl->getExtension();

	if ($extdoc == "doc" or $extdoc  == "docx") {
		$data3['id_cat_file'] = "3";
	} else if ($extdoc == "csv" or $extdoc  == "xls" or $extdoc  == "xlsx") {
		$data3['id_cat_file'] = "4";
	} else if ($extdoc == "pdf") {
		$data3['id_cat_file'] = "5";
	} else {
		unlink(FCPATH . '/storage/doc_media_user/' . $file["file_name"]);
		return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document gagal ditambahkan</div>');
	}
	$data3['produk_id'] = $id_prod;
	$data3['name_document'] = $file["file_name"];
	return $this->db->insert('user_product_document', $data3);
}
}