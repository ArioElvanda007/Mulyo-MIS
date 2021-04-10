<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Model {

	public function getJob_SIMPLE() {
		return $this->db->query("
			SELECT JobNo,JobNm,Provinsi,Instansi,HPS,StatusJob FROM Job ORDER BY JobNo DESC
		")->result_object();
	}
	public function getAllCount() {
		return $this->db->query("
			SELECT COUNT(*) AS count FROM Job 
		")->row_object();
	}
	public function getAllData($limit, $start, $order, $dir) {
		return $this->db->query("
			SELECT JobNo,JobNm,Provinsi,Instansi,HPS,StatusJob 
			FROM Job 
			ORDER BY $order $dir 
            OFFSET $start ROWS 
			FETCH NEXT $limit ROWS ONLY;
		")->result_object();
	}
	public function getAllData_search($limit, $start, $search, $order, $dir) {
		$search = strtolower($search);
		return $this->db->query("
			SELECT JobNo,JobNm,Provinsi,Instansi,HPS,StatusJob 
			FROM Job 
			WHERE LOWER(JobNo) LIKE '%$search%' 
			OR LOWER(JobNm) LIKE '%$search%' 
			OR LOWER(Provinsi) LIKE '%$search%' 
			OR LOWER(Instansi) LIKE '%$search%' 
			OR LOWER(HPS) LIKE '%$search%' 
			OR LOWER(StatusJob) LIKE '%$search%' 
			OFFSET $start ROWS 
			FETCH NEXT $limit ROWS ONLY;
		")->result_object();
	}
	public function getAllCount_search($search) {
		$search = strtolower($search);
		return $this->db->query("
			SELECT COUNT(*) AS count FROM Job  
			FROM Job 
			WHERE LOWER(JobNo) LIKE '%$search%' 
			OR LOWER(JobNm) LIKE '%$search%' 
			OR LOWER(Provinsi) LIKE '%$search%' 
			OR LOWER(Instansi) LIKE '%$search%' 
			OR LOWER(HPS) LIKE '%$search%' 
			OR LOWER(StatusJob) LIKE '%$search%' 
		")->row_object();
	}

}

/* End of file Job.php */
/* Location: ./application/models/Job.php */