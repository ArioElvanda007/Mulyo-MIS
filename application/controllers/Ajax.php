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
			$data[$row]->DrTgl_toPeriode = $this->dateToPeriode($value->DrTgl);
			$data[$row]->SpTgl_toPeriode = $this->dateToPeriode($value->SpTgl);
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
			// $data['Tahap'] = $this->Tahap->post();
			// $data['NamaSistem'] = $this->sistemPengadaan->post();
			// $data['DrTgl'] = $this->DrTgl->post();
			// $data['SpTgl'] = $this->SpTgl->post();
			if ($data['LedgerNo'] <= 0) {
				$data['TimeEntry'] = date('Y-m-d H:i:s');
				$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
				$this->job->insertTahapanTender($data);
				unset($data['LedgerNo']);
			} else {
				$LedgerNo = $data['LedgerNo'];
				unset($data['LedgerNo']);
				$this->job->updateTahapanTender($data, $LedgerNo);
				// INSERT TO EDIT RECORD
				$this->job->insertEditTahapanTender([
					'JobNo' => $data['JobNo'],
					'NamaTahapan' => $data['Tahap'],
					'DrTgl' => $data['DrTgl'],
					'SpTgl' => $data['SpTgl'],
					'UserEntry' => $this->session->userdata('MIS_LOGGED_NAME'),
					'TimeEntry' => date('Y-m-d H:i:s'),
					'NamaSistem' => $data['NamaSistem']
				]);
			}
			echo "success";
		} else {
			echo "failure";
		}
	}
	public function getMPPbyJobNo($JobNo) {
		$data = $this->job->getMPPbyJobNo($JobNo);
		foreach ($data as $row => $value) {
			$TakeHomePay = 0;
			$arr = explode('.', $value->TakeHomePay);
			if (isset($arr[0])) {
				$TakeHomePay = $arr[0];
			}
			$data[$row]->TakeHomePay = number_format($TakeHomePay);
		}
		echo json_encode($data);
	}
	public function addMPP() {
		if ($this->input->post()) {
			$data = $this->input->post();
			$karyawan = $this->input->post('karyawan');
			unset($data['karyawan']);
			$arr = explode('-', $karyawan);
			if (isset($arr[0]) && isset($arr[1])) {
				$data['NIK'] = $arr[0];
				$data['Nama'] = $arr[1];
			}
			$data['TakeHomePay'] = str_replace(',', '', $data['TakeHomePay']);
			$data['TimeEntry'] = date('Y-m-d H:i:s');
			$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
			$this->job->insertMPP($data);
			echo "success";
		} else {
			echo "failure";
		}
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */