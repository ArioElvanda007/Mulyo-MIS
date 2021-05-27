<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index() {
		// $this->parseData['title'] = 'Dashboard';
		// $this->load->view('Main', $this->parseData);
		redirect('Basic/job');
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */