<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('MIS_LOGGED_TOKEN')) {
			redirect('Main');
		}
		$this->load->model('Users','users',TRUE);
	}

	public function index() {
		if ($this->input->post()) {
			$user = $this->users->getUserByUsername($this->input->post('username'));
			if ($user) {
				if (password_verify($this->input->post('password'), $user->PasswordCI)) {
					$this->session->set_userdata([
						'MIS_LOGGED_CORP' => $this->input->post('corp'),
						'MIS_LOGGED_NAME' => $user->UserName,
						'MIS_LOGGED_TOKEN' => json_encode($user)
					]);
					$this->setMessage('Yeeaayy','success','Login berhasil, selamat datang '. $user->UserName);
					redirect('Main');
				} else {
					$this->session->set_flashdata('login_error','Username dan password tidak sesuai');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('login_error','Username tidak terdaftar');
				redirect('Auth');
			}
		} else {
			$this->load->view('Auth');
		}
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */