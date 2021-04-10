<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $parseData = [
		'content' => 'content/dashboard',
		'title' => 'AIS',
	];

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if (!$this->session->userdata('MIS_LOGGED_TOKEN')) {
			redirect('Auth');
		}
		$this->load->model('Instansi','instansi',TRUE);
		$this->load->model('TahapanTender','tahapanTender',TRUE);
		$this->load->model('InfoPasar','infoPasar',TRUE);
		$this->load->model('Karyawan','karyawan',TRUE);
		$this->load->model('Job','job',TRUE);
	}
	public function dateToPeriode($date) {
		$month = substr($date, 5,2);
		$year = substr($date, 0,4);
		return $this->genMonth($month).'-'.$year;

	}
	public function beautyDate($date,$withTime = null) {
		$response = substr($date, 8,2).' '.$this->genMonth(substr($date, 5,2)).' '.substr($date, 0,4);
		if ($withTime) {
			$response .= ' '.substr($date, 11,5);
		}
		return $response;
	}
	public function genMonth($value) {
		$callback = 'January';
		switch ($value) {
			case '01':
				$callback = 'January';
				break;
			case '02':
				$callback = 'February';
				break;
			case '03':
				$callback = 'Maret';
				break;
			case '04':
				$callback = 'April';
				break;
			case '05':
				$callback = 'Mei';
				break;
			case '06':
				$callback = 'Juni';
				break;
			case '07':
				$callback = 'July';
				break;
			case '08':
				$callback = 'Agustus';
				break;
			case '09':
				$callback = 'September';
				break;
			case '10':
				$callback = 'Oktober';
				break;
			case '11':
				$callback = 'November';
				break;
			case '12':
				$callback = 'Desember';
				break;
		}
		return $callback;
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */