<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends MY_Controller {

	public function index() {
		$this->rap();
	}
	public function rap() {
		$this->parseData['job'] = $this->job->getJob_SIMPLE();
		$this->parseData['alokasi'] = $this->global->getAlokasi();
		$this->parseData['title'] = "Entry RAP";
		$this->parseData['content'] = "content/entry/rap";
		$this->load->view('Main', $this->parseData);
	}

}

/* End of file Entry.php */
/* Location: ./application/controllers/Entry.php */