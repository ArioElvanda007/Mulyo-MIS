<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahapanTender extends CI_Model {

	// SISTEM PENGADAAN
	public function getMasterTahapan() {
		$this->db->order_by('id_SisPeng', 'ASC');
		return $this->db->get('SistemPengadaan')->result_object();
	}
	public function getMasterTahapanById($id_SisPeng) {
		$this->db->where('id_SisPeng', $id_SisPeng);
		return $this->db->get('SistemPengadaan')->row_object();
	}
	public function insertMasterTahapan($data) {
		return $this->db->insert('SistemPengadaan', $data);
	}
	public function updateMasterTahapan($data, $id_SisPeng) {
		$this->db->where('id_SisPeng', $id_SisPeng);
		return $this->db->update('SistemPengadaan', $data);
	}
	public function deleteMasterTahapan($id_SisPeng) {
		$this->db->where('id_SisPeng', $id_SisPeng);
		return $this->db->delete('SistemPengadaan');
	}

	// TAHAPAN TENDER
	public function getTahapanTender($id_SisPeng = null) {
		if ($id_SisPeng) {
			$this->db->where('id_SisPeng', $id_SisPeng);
		}
		$this->db->order_by('id_tahapan', 'ASC');
		return $this->db->get('MasterTahapanTender')->result_object();
	}
	public function getTahapanTenderById($id_tahapan) {
		$this->db->where('id_tahapan', $id_tahapan);
		return $this->db->get('MasterTahapanTender')->row_object();
	}
	public function insertTahapanTender($data) {
		return $this->db->insert('MasterTahapanTender', $data);
	}
	public function updateTahapanTender($data, $id_tahapan) {
		$this->db->where('id_tahapan', $id_tahapan);
		return $this->db->update('MasterTahapanTender', $data);
	}
	public function deleteTahapanTender($id_tahapan) {
		$this->db->where('id_tahapan', $id_tahapan);
		return $this->db->delete('MasterTahapanTender');
	}

}

/* End of file TahapanTender.php */
/* Location: ./application/models/TahapanTender.php */