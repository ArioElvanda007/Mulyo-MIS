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
			SELECT COUNT(*) AS count FROM Job WHERE company = 'PRA' AND TipeJob = 'Project' 
		")->row_object();
	}
	public function getAllData($limit, $start, $order, $dir) {
		return $this->db->query("
			SELECT JobNo,JobNm,Provinsi,Instansi,HPS,StatusJob,Deskripsi,Kategori
			FROM Job WHERE company = 'PRA' AND TipeJob = 'Project' 
			ORDER BY $order $dir 
            OFFSET $start ROWS 
			FETCH NEXT $limit ROWS ONLY;
		")->result_object();
	}
	public function getAllData_search($limit, $start, $search, $order, $dir) {
		$search = strtolower($search);
		return $this->db->query("
			SELECT JobNo,JobNm,Provinsi,Instansi,HPS,StatusJob,Deskripsi,Kategori 
			FROM Job 
			WHERE LOWER(JobNo) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(JobNm) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(Provinsi) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(Instansi) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(HPS) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(StatusJob) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			ORDER BY $order $dir 
			OFFSET $start ROWS 
			FETCH NEXT $limit ROWS ONLY;
		")->result_object();
	}
	public function getAllCount_search($search) {
		$search = strtolower($search);
		return $this->db->query("
			SELECT COUNT(*) AS count FROM Job  
			WHERE LOWER(JobNo) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(JobNm) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(Provinsi) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(Instansi) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(HPS) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
			OR LOWER(StatusJob) LIKE '%$search%' AND company = 'PRA' AND TipeJob = 'Project' 
		")->row_object();
	}
	public function getJobByJobNo($JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->get('Job')->row_object();
	}
	public function getPembukaanByJobNo($JobNo) {
		return $this->db->query("SELECT HasilPembukaan FROM Job WHERE JobNo = '$JobNo'")->row_object();
	}
	public function insertProposal($data) {
		return $this->db->insert('Job', $data);
	}
	public function insertProposalTender($data) {
		return $this->db->insert('PesertaTender', $data);
	}
	public function updateProposalTender($data, $IdPeserta) {
		$this->db->where('IdPeserta', $IdPeserta);
		return $this->db->update('PesertaTender', $data);
	}
	public function deleteProposalTenderByJobNo($JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->delete('PesertaTender');
	}
	public function updateJob($data, $JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->update('Job', $data);
	}
	public function getTahapanTenderByJobNo($JobNo) {
		return $this->db->query("
			SELECT 
			    TahapanTender.*,
			    MasterTahapanTender.id_SisPeng,
			    (
			    	SELECT COUNT(*) FROM EditTahapanTender 
			    	WHERE EditTahapanTender.JobNo = TahapanTender.JobNo 
			    ) AS count
			FROM TahapanTender 
			LEFT JOIN MasterTahapanTender ON MasterTahapanTender.NamaTahapan = TahapanTender.Tahap 
			AND MasterTahapanTender.NamaSistem = TahapanTender.NamaSistem
			WHERE TahapanTender.JobNo = '$JobNo';
		")->result_object();
	}
	public function insertTahapanTender($data) {
		return $this->db->insert('TahapanTender', $data);
	}
	public function insertEditTahapanTender($data) {
		return $this->db->insert('EditTahapanTender', $data);
	}
	public function updateTahapanTender($data, $LedgerNo) {
		$this->db->where('LedgerNo', $LedgerNo);
		return $this->db->update('TahapanTender', $data);
	}
	public function getTahapanTenderByJobNo_SINGLE($JobNo) {
		$this->db->order_by('TimeEntry', 'desc');
		$this->db->where('JobNo', $JobNo);
		return $this->db->get('TahapanTender')->row_object();
	}
	public function getPesertaTenderByJobNo_SINGLE_ARR($JobNo) {
		$this->db->order_by('TimeEntry', 'desc');
		$this->db->where('JobNo', $JobNo);
		return $this->db->get('PesertaTender')->row_array();
	}
	public function getPesertaTenderByJobNo($JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->get('PesertaTender')->result_object();
	}
	public function getMPPbyJobNo($JobNo) {
		$this->db->where('JobNo', $JobNo);
		$this->db->order_by('TimeEntry', 'DESC');
		return $this->db->get('MPP')->result_object();
	}
	public function insertMPP($data) {
		return $this->db->insert('MPP', $data);
	}
}

/* End of file Job.php */
/* Location: ./application/models/Job.php */