<?php
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class m_userdata extends CI_Model
{
    public function userData()
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
        $this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
        $this->db->where('user_data.status', 'active');
        return $this->db->get();
    }


    public function getuserData($id)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
        $this->db->join('user_keahlian', 'user_keahlian.id_keahlian = user_data.id_keahlian_user', 'left');
        $this->db->where('user_data.id_user', $id);
        return $this->db->get();
    }
    public function tampil_galery($id)
    {
        $this->db->select('*');
        $this->db->from('user_produk');
        $this->db->where('id_user =' . $id);
        return $this->db->get();
    }
    public function tampil_document($id)
    {
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_user =' . $id);
        return $this->db->get();
    }
    public function tampil_kegiatan($id)
    {
        $sql = "SELECT DISTINCT kegiatan, tanggal_kegiatan FROM user_kegiatan LEFT JOIN user_produk ON user_produk.id_produk=user_kegiatan.produk_id WHERE kegiatan IS NOT NULL AND user_produk.id_user=$id AND user_produk.status_produk=2";
        return $this->db->query($sql);
    }
    public function list_kegiatan()
    {
        $this->db->select('*');
        $this->db->from('daftar_kegiatan');
        return $this->db->get();
    }
    public function getDataExport($id)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
        $this->db->where('id_user', $id);
        return $this->db->get()->row();
    }
    public function getDataExcel($id)
    {
        $kegiatan = $this->_getKegiatanUser($id)->result();
        $user = $this->_getUserById($id)->row();

        $spreadsheet = new Spreadsheet;

        // PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('A2', 'Email')
            ->setCellValue('A3', 'Alamat')
            ->setCellValue('A4', 'HP / Whatsapp')
            ->setCellValue('A5', 'Ketegori')
            ->setCellValue('A6', 'Instansi')
            ->setCellValue('A7', 'Gender')
            ->setCellValue('A8', 'Tentang')
            ->setCellValue('A9', 'Keahlian')
            ->setCellValue('D1', 'Riwayat Kegiatan')
            ->setCellValue('E1', 'Tanggal Kegiatan');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B1', $user->fullname)
            ->setCellValue('B2', $user->email)
            ->setCellValue('B3', $user->address_user)
            ->setCellValue('B4', $user->phone_user)
            ->setCellValue('B5', $user->category_user)
            ->setCellValue('B6', $user->instansi)
            ->setCellValue('B7', $user->gender)
            ->setCellValue('B8', $user->about)
            ->setCellValue('B9', $user->keahlian_user);
        $kolom = 2;
        foreach ($kegiatan as $kgtn) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('D' . $kolom, $kgtn->kegiatan)
                ->setCellValue('E' . $kolom, $kgtn->tanggal_kegiatan);
            $kolom++;
        }
        foreach (range('A', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
            $spreadsheet->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data ' . $user->fullname . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    private function _getUserById($id)
    {
        $sql = "SELECT user_data.*, user_kategori.category_user, user_keahlian.keahlian_user
        FROM user_data
        LEFT JOIN user_kategori ON user_kategori.id_cat = user_data.id_category_user
        LEFT JOIN user_keahlian ON user_keahlian.id_keahlian = user_data.id_keahlian_user
        WHERE user_data.status='active'
        AND user_data.id_user=$id";

        return $this->db->query($sql);
    }
    private function _getKegiatanUser($id)
    {
        $sql = "SELECT DISTINCT kegiatan, tanggal_kegiatan FROM user_kegiatan LEFT JOIN user_produk ON user_produk.id_produk=user_kegiatan.produk_id WHERE kegiatan IS NOT NULL AND user_produk.id_user=$id AND user_produk.status_produk=2";
        return $this->db->query($sql);
    }
    public function getUsersExport()
    {
        $userall = $this->_getAllUsers()->result();

        $spreadsheet = new Spreadsheet;

        // PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Email')
            ->setCellValue('D1', 'Alamat')
            ->setCellValue('E1', 'HP / Whatsapp')
            ->setCellValue('F1', 'Ketegori')
            ->setCellValue('G1', 'Instansi')
            ->setCellValue('H1', 'Gender')
            ->setCellValue('I1', 'Tentang')
            ->setCellValue('J1', 'Keahlian')
            ->setCellValue('K1', 'Riwayat Kegiatan')
            ->setCellValue('L1', 'Tanggal Kegiatan');
        $kolom = 2;
        $nomor = 1;
        foreach ($userall as $pengguna) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $pengguna->fullname)
                ->setCellValue('C' . $kolom, $pengguna->email)
                ->setCellValue('D' . $kolom, $pengguna->address_user)
                ->setCellValue('E' . $kolom, $pengguna->phone_user)
                ->setCellValue('F' . $kolom, $pengguna->category_user)
                ->setCellValue('G' . $kolom, $pengguna->instansi)
                ->setCellValue('H' . $kolom, $pengguna->gender)
                ->setCellValue('I' . $kolom, $pengguna->about)
                ->setCellValue('J' . $kolom, $pengguna->keahlian_user)
                ->setCellValue('K' . $kolom, $pengguna->kegiatan)
                ->setCellValue('L' . $kolom, $pengguna->tanggal_kegiatan);
            $kolom++;
            $nomor++;
        }

        foreach (range('A', $spreadsheet->getActiveSheet()->getHighestDataColumn()) as $col) {
            $spreadsheet->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Daftar Stakeholder.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    private function _getAllUsers()
    {
        $sql = "SELECT DISTINCT user_data.*, user_kategori.category_user, user_keahlian.keahlian_user, user_kegiatan.kegiatan, user_kegiatan.tanggal_kegiatan FROM user_data LEFT JOIN user_kategori ON user_kategori.id_cat = user_data.id_category_user LEFT JOIN user_keahlian ON user_keahlian.id_keahlian = user_data.id_keahlian_user LEFT JOIN user_produk ON user_produk.id_user = user_data.id_user LEFT JOIN user_kegiatan ON user_kegiatan.produk_id = user_produk.id_produk WHERE user_data.status='active'";

        return $this->db->query($sql);
    }











    public function addKegiatan($id)
    {
        $post = $this->input->post();
        $this->kegiatan_id = $post['kegiatan'];
        $this->user_id = $id;
        $this->waktu_mulai_kegiatan = $post['tanggal_mulai'];
        $this->waktu_selesai_kegiatan = $post['tanggal_selesai'];

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Document berhasil ditambahkan</div>');
        return $this->db->insert('user_kegiatan', $this);
    }
    public function editKegiatan($idedit)
    {
        $post = $this->input->post();
        $this->kegiatan_id = $post['kegiatan'];
        $this->waktu_mulai_kegiatan = $post['tanggal_mulai'];
        $this->waktu_selesai_kegiatan = $post['tanggal_selesai'];

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Document berhasil diubah</div>');
        return $this->db->update('user_kegiatan', $this, array('id_user_kegiatan' => $idedit));
    }
    public function deleteKegiatan($idhapus)
    {
        $this->db->where('id_user_kegiatan', $idhapus);
        $this->db->delete('user_kegiatan');
        return $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Document berhasil dihapus</div>');
    }
}
