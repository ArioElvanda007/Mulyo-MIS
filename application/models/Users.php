<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	public function getUserByUsername($UserID, $id = null) {
		$this->db->where('UserID', $UserID);
		if ($id) {
			$this->db->where('id', $id);
		}
		return $this->db->get('Login')->row_object();
	}

}

/* End of file Users.php */
/* Location: ./application/models/Users.php */