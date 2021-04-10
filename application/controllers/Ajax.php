<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function index() {
		redirect('Main');
	}

	public function getSubByInstansi($Id_Instansi) {
		echo json_encode($this->instansi->getSubInstansi($Id_Instansi));
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */