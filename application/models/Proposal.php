<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Model {

    public function data_job()
    {
        $query = $this->db->query("SELECT * From Job ORDER BY JobNo DESC");
        return $query;
    }	

}

/* End of file Proposal.php */
/* Location: ./application/models/Proposal.php */