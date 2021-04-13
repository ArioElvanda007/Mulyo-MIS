<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function index() {
		redirect('Main');
	}

	public function getSubByInstansi($Id_Instansi) {
		echo json_encode($this->instansi->getSubInstansi($Id_Instansi));
	}
	public function getInfoPasarById($InfoPasarId) {
		echo json_encode($this->infoPasar->getInfoPasarById($InfoPasarId));
	}
	public function getTahapanTenderByJobNo($JobNo) {
		$data = $this->job->getTahapanTenderByJobNo($JobNo);
		foreach ($data as $row => $value) {
			$data[$row]->DrTgl = $this->dateToPeriode($value->DrTgl);
			$data[$row]->SpTgl = $this->dateToPeriode($value->SpTgl);
			$data[$row]->TimeEntry = $this->beautyDate($value->TimeEntry, true);
		}
		echo json_encode($data);
	}
	public function getTahapanTenderBySispeng($id_SisPeng) {
		echo json_encode($this->tahapanTender->getTahapanTender($id_SisPeng));
	}
	public function getPembukaanByJobNo($JobNo) {
		echo json_encode($this->job->getPembukaanByJobNo($JobNo));
	}
	public function addTahapanTender() {
		if ($this->input->post()) {
			$data = $this->input->post();
			$data['TimeEntry'] = date('Y-m-d H:i:s');
			$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
			$this->job->insertTahapanTender($data);
			echo "success";
		} else {
			echo "failure";
		}
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */