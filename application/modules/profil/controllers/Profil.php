<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['title'] = "Profile";
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		// modules::run('templates/Templates');
		// $this->load->view('header', $data);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('profil/profil', $data);
		$this->load->view('templates/footer');
	}
	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'FULL NAME', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('profil/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email');
			$config['upload_path']   = FCPATH . './assets/images/users/';
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_size']      = '5090';
			//   	$config['max_width']     = '1024';
			//   	$config['max_height']    = '768';
			$config['file_name']     = url_title($this->input->post('image'));

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')) {
				$data = array(
					'name' => $this->input->post('name'),
					'telephone' => $this->input->post('telephone')
				);
				$this->db->where('email', $email);
				$this->db->update('user', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Profil has been Update!
			</div>');
				redirect('profil');
			} else {
				$old_image = $data['user']['image'];
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . './assets/images/users/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$data = array(
					'name' => $this->input->post('name'),
					'telephone' => $this->input->post('telephone'),
					'image' => $new_image
				);
				$this->db->where('email', $email);
				$this->db->update('user', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Profil has been Update!
			</div>');
				redirect('profil');
			}
		}
	}
	public function changepassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'trim|required|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('profil/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Current Password!
                </div>');
				redirect('profil/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Current Password cant be same!
                    </div>');
					redirect('profil/changepassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password has been Change!
                    </div>');
					redirect('profil');
				}
			}
		}
	}
}
