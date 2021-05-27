<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private function barDashboard($year) {
		return $this->db->query("
			SELECT SUM(Job.Netto) AS netto FROM Job 
		    WHERE 
		    	Job.StatusJob = 'Pelaksanaan' AND LEFT(Job.TglKontrak, 4) = '$year'
		    OR Job.StatusJob = 'Pemeliharaan' AND LEFT(Job.TglKontrak, 4) = '$year'
		    OR Job.StatusJob = 'Closed' AND LEFT(Job.TglKontrak, 4) = '$year'
		")->row_object();
	}
	private function lineDashboard($year) {
		return $this->db->query("
			SELECT (
				SELECT COUNT(JobNo) FROM Job WHERE LEFT(Job.TglKontrak, 4) = '$year'
			) AS total,
			(
				SELECT COUNT(JobNo) FROM Job WHERE Job.StatusJob = 'Proposal' AND LEFT(Job.TglKontrak, 4) = '$year'
			) AS proposal,
			(
				SELECT COUNT(JobNo) FROM Job WHERE Job.StatusJob = 'Pelaksanaan' AND LEFT(Job.TglKontrak, 4) = '$year' 
				OR Job.StatusJob = 'Pemeliharaan' AND LEFT(Job.TglKontrak, 4) = '$year'
			) AS menang,
			(
				SELECT COUNT(JobNo) FROM Job WHERE Job.StatusJob = 'Gagal' AND LEFT(Job.TglKontrak, 4) = '$year'
			) AS gagal;
		")->row_object();
	}
	private function getConfig($year) {
		return $this->db->query("
			SELECT * FROM Target WHERE LEFT(TahunTarget, 4) = '$year'
		")->row_object();
	}
	private function getTotalProject($year, $status = null) {
		$whereStatus = '';
		if ($status) {
			$whereStatus = " AND StatusJob = '$status' ";
		}
		return $this->db->query("
			SELECT COUNT(JobNo) AS count FROM Job WHERE LEFT(TglKontrak, 4) = '$year' $whereStatus
		")->row_object();
	}
	private function getRAP($year) {
		return $this->db->query("
			SELECT (
				SELECT SUM(HrgRAB) FROM RAP WHERE LEFT(TimeEntry, 4) = '$year'
			) AS total,
			(
				SELECT COUNT(TotalTerserap) FROM RAP WHERE LEFT(TimeEntry, 4) = '$year'
			) AS penyerapan;
		")->row_object();
	}
	private function getJobs() {
		return $this->db->query("
			SELECT TOP 10 JobNm,JobNo,StatusJob,Netto 
			FROM Job 
			ORDER BY TimeEntry DESC;
		")->result_object();
	}

	public function index() {
		// ONE
		$one = [
			'years' => [],
			'datas' => []
		];
		foreach (range((date('Y') - 2), date('Y')) as $row => $value) {
			array_push($one['years'], $value);
			array_push($one['datas'], ceil($this->barDashboard($value)->netto));
		}
		$this->load->view('front/dashboard', [
			'one' => json_encode($one),
			'target' => $this->getConfig(date('Y')),
			'totalProject' => $this->getTotalProject(date('Y'))->count,
			'totalProject_pelaksana' => $this->getTotalProject(date('Y'), 'Pelaksanaan')->count,
			'rap' => $this->getRAP(date('Y')),
			'jobs' => $this->getJobs()
		]);
	}

	// AJAX
	public function chart_two() {
		$arr = [];
		foreach ($this->lineDashboard($this->input->post('year')) as $row => $value) {
			array_push($arr, $value);
		}
		echo json_encode($arr);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */