<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index() {
		$this->parseData['title'] = 'Dashboard';
		$this->load->view('Main', $this->parseData);
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}
	public function updatePassword() {
		if ($this->input->post()) {
			$token = json_decode($this->session->userdata('MIS_LOGGED_TOKEN'));
			$this->users->updateUser([
				'PasswordCI' => crypt($this->input->post('Password'), '')
			],$token->UserID);
			$this->setMessage('Berhasil','success','Password anda berhasil diubah!');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */