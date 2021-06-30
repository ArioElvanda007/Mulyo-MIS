<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GlobalModel extends CI_Model {

	public function getAlokasi() {
		return $this->db->query("
			SELECT 
				Alokasi, Keterangan 
			FROM Alokasi 
			ORDER BY Alokasi ASC, Keterangan ASC
		")->result_object();
	}

}

/* End of file GlobalModel.php */
/* Location: ./application/models/GlobalModel.php */