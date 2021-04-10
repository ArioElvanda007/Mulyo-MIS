<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends CI_Model {

	// INSTANSI
	public function getInstansi() {
		$this->db->order_by('Id_Instansi', 'ASC');
		return $this->db->get('InstansiPemerintah')->result_object();
	}
	public function getInstansiById($Id_Instansi) {
		$this->db->where('Id_Instansi', $Id_Instansi);
		return $this->db->get('InstansiPemerintah')->row_object();
	}
	public function insertInstansi($data) {
		return $this->db->insert('InstansiPemerintah', $data);
	}
	public function updateInstansi($data, $Id_Instansi) {
		$this->db->where('Id_Instansi', $Id_Instansi);
		return $this->db->update('InstansiPemerintah', $data);
	}
	public function deleteInstansi($Id_Instansi) {
		$this->db->where('Id_Instansi', $Id_Instansi);
		return $this->db->delete('InstansiPemerintah');
	}

	// SUB INSTANSI
	public function getSubInstansi($Id_Ditjen = null) {
		if ($Id_Ditjen) {
			$this->db->where('Id_Ditjen', $Id_Ditjen);
		}
		$this->db->order_by('Id_SubInstansi', 'ASC');
		return $this->db->get('SubInstansi')->result_object();
	}
	public function getSubInstansiById($Id_SubInstansi) {
		$this->db->where('Id_SubInstansi', $Id_SubInstansi);
		return $this->db->get('SubInstansi')->row_object();
	}
	public function insertSubInstansi($data) {
		return $this->db->insert('SubInstansi', $data);
	}
	public function updateSubInstansi($data, $Id_SubInstansi) {
		$this->db->where('Id_SubInstansi', $Id_SubInstansi);
		return $this->db->update('SubInstansi', $data);
	}
	public function deleteSubInstansi($Id_SubInstansi) {
		$this->db->where('Id_SubInstansi', $Id_SubInstansi);
		return $this->db->delete('SubInstansi');
	}

}

/* End of file Instansi.php */
/* Location: ./application/models/Instansi.php */