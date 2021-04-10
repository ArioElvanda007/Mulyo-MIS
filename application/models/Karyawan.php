<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Model {

	public function getKaryawan_SIMPLE() {
		return $this->db->query("
			SELECT NIK,Nama FROM Karyawan ORDER BY Nama ASC
		")->result_object();
	}

}

/* End of file Karyawan.php */
/* Location: ./application/models/Karyawan.php */