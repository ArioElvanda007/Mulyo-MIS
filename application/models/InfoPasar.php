<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InfoPasar extends CI_Model {

	public function getInfoPasar() {
		$this->db->order_by('jobNo', 'DESC');
		return $this->db->get('InfoPasar')->result_object();
	}
	public function getInfoPasar_SIMPLE() {
		return $this->db->query("
			SELECT InfoPasarId,jobNo From InfoPasar ORDER BY jobNo DESC
		")->result_object();
	}
	public function getInfoPasarById($InfoPasarId) {
		$this->db->where('InfoPasarId', $InfoPasarId);
		return $this->db->get('InfoPasar')->row_object();	
	}
	public function insertInfoPasar($data) {
		return $this->db->insert('InfoPasar', $data);
	}
	public function updateInfoPasar($data, $InfoPasarId) {
		$this->db->where('InfoPasarId', $InfoPasarId);
		return $this->db->update('InfoPasar', $data);
	}
	public function deleteInfoPasar($InfoPasarId) {
		$this->db->where('InfoPasarId', $InfoPasarId);
		return $this->db->delete('InfoPasar');
	}
	public function getLastJobNoByYear($year) {
		return $this->db->query("
			SELECT TOP 1 jobNo FROM InfoPasar WHERE LEFT(jobNo, 2) = '$year' ORDER BY jobNo DESC
		")->row_object();
	}

	// MPP
	public function getMppByInfoPasar($InfoPasarId) {
		$this->db->where('InfoPasarId', $InfoPasarId);
		return $this->db->get('MPP')->result_object();
	}
	public function insertMpp($data) {
		return $this->db->insert('MPP', $data);
	}
	public function updateMpp($data, $LedgerNo) {
		$this->db->where('LedgerNo', $LedgerNo);
		return $this->db->update('MPP', $data);
	}
	public function deleteMpp($LedgerNo) {
		$this->db->where('LedgerNo', $LedgerNo);
		return $this->db->delete('MPP');
	}

}

/* End of file InfoPasar.php */
/* Location: ./application/models/InfoPasar.php */