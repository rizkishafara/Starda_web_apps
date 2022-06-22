<?php

use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class m_dashboard extends CI_Model
{
    //get data from last 5 months
    public function getYear()
    {
        // $this->db->select('upload_date');
        // $this->db->from('user_produk');
        // $this->db->where('upload_date >=', DATE_ADD(Month, -3, getdate()));
        // return $this->db->get();
        // $sql="SELECT upload_date FROM user_produk WHERE upload_date >= DATE_ADD(month, 2, upload_date)";
        $sql = "SELECT DISTINCT YEAR(upload_date) as year FROM user_produk GROUP BY upload_date DESC";
        return $this->db->query($sql);
    }
    public function getJumlahUnggah($tahun)
    {
        for ($bulan = 1; $bulan < 13; $bulan++) {
            // $query = "SELECT sum(jumlah) as jumlah from tb_penjualan where MONTH(tgl_penjualan)='$bulan'";
            $query = "SELECT * FROM user_produk WHERE YEAR(upload_date) = $tahun AND MONTH(upload_date) = $bulan";
            $jumlah[] = $this->db->query($query)->num_rows();
        }

        return $jumlah;
    }
    public function getKategoriUser()
    {
        $sql = "SELECT category_user FROM user_kategori";
        return $this->db->query($sql);
    }
    public function getUser()
    {
        $kategori = $this->_getAllKategori()->result();
        foreach ($kategori as $kat) {
            $sql = "SELECT * FROM user_data WHERE id_category_user=$kat->id_cat";
            $jumlah[] = $this->db->query($sql)->num_rows();
        }
        return $jumlah;

        // $sql="SELECT user_data.id_category_user,COUNT(user_data.id_category_user) as jumlah FROM user_data LEFT JOIN user_kategori ON user_kategori.id_cat = user_data.id_category_user GROUP BY id_category_user";
        // return $this->db->query($sql);
    }
    private function _getAllKategori()
    {
        $sql = "SELECT id_cat FROM user_kategori";
        return $this->db->query($sql);
    }
}
