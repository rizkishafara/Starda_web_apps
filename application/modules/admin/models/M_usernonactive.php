<?php
class m_usernonactive extends CI_Model
{
    public function usernonactive()
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('user_kategori', 'user_kategori.id_cat = user_data.id_category_user');
        $this->db->where('status', 'non active');
        return $this->db->get();
    }
    public function sendEmail($id)
    {
        $userdata = $this->db->get_where('user_data', ['id_user' => $id])->row();

        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'stardabpmpk@gmail.com',  // Email gmail
            'smtp_pass'   => 'grahatama',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        // $this->email->from('no-reply@masrud.com', 'MasRud.com');
        $this->email->from('no-reply@starda.kemdikbud.go.id', 'starda');

        // Email penerima
        $this->email->to($userdata->email); // Ganti dengan email tujuan

        // Subject email
        $this->email->subject('Member Activation');

        // Isi email
        return $this->email->message("<p>Halo".$userdata->fullname." !, akun member anda telah aktif, sekarang anda dapat login menggunakan email serta password berikut</p>
        <br>
        <table>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>".$userdata->email."</td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>stakeholder</td>
            </tr>
        </table>
        <br>
        <p>Jika ada pertanyaan lebih lanjut, anda dapat mengubungi admin</p>");
    }
}
