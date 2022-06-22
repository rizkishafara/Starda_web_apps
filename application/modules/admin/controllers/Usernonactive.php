<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usernonactive extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->login_admin->cek_login();
		$this->load->model('m_usernonactive');
	}
	public function index()
	{
		$data['title'] = 'Pengajuan Akun';
		$data['admin'] = $this->db->get_where('admin', ['id_admin' => $this->session->userdata('id_admin')])->row();

		$data['usernonactive'] = $this->m_usernonactive->usernonactive()->result();

		$this->load->view('template/admin/header_view', $data);
		$this->load->view('template/admin/sidebar_view');
		$this->load->view('template/admin/navbar_view', $data);
		$this->load->view('usernonactive/usernonactive_v', $data);
		$this->load->view('template/admin/footer_view');
	}
	public function activation($id)
	{
		$userdata = $this->db->get_where('user_data', ['id_user' => $id])->row();

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

		$this->load->library('email', $config);
		$this->email->from('noreply@starda.kemdikbud.go.id', 'starda');
		$this->email->to($userdata->email);
		$this->email->subject('Member Activation');

		$this->email->message("<p>Halo " . $userdata->fullname . " !. Akun member anda telah aktif, sekarang anda dapat login menggunakan email serta password berikut</p><br><table> <tr><td>Email</td><td>:</td><td>" . $userdata->email . "</td></tr><tr> <td>Password</td><td>:</td><td>stakeholder</td></tr></table><br><p>Jika ada pertanyaan lebih lanjut, anda dapat mengubungi admin</p>");

		if ($this->email->send()) {
			$this->status = 'active';
			$this->db->update('user_data', $this, array('id_user' => $id));

			$this->session->set_flashdata('pesan', '<div class="alert alert-success " role="alert">User berhasil diaktivasi</div>');
			redirect('admin/Usernonactive');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger " role="alert">Email tidak Valid</div>');
			redirect('admin/Usernonactive');
		}
	}
	public function delete_akun($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('user_data');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger " role="alert">Data berhasil dihapus</div>');
		redirect('admin/Usernonactive');
	}
	public function send_email()
	{
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
		$this->email->to('rizkishafara99@gmail.com'); // Ganti dengan email tujuan

		// Lampiran email, isi dengan url/path file
		$this->email->attach('https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

		// Subject email
		$this->email->subject('Member Activation');

		// Isi email
		$this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/kirim-email-codeigniter/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");
	}
}
