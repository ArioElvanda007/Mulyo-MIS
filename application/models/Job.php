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
		return $this->db->query("
			SELECT Job.*,InfoPasar.SDDN 
			FROM Job 
			LEFT JOIN InfoPasar ON InfoPasar.jobNo = Job.JobNo 
			WHERE Job.JobNo = '$JobNo'
		")->row_object();
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

	public function insertPesertaTenderLeader($data) {
		return $this->db->insert('PesertaTenderLeader', $data);
	}

	public function getPesertaTenderLeader() {
		return $this->db->query("
			select * from PesertaTenderLeader order by idLeader DESC
		")->row_object();
	}

	public function updateJobTender($JobNo) {
		$query = $this->db->query("
			select count(*) as total from PesertaTender where JobNo = '$JobNo'
		")->row_object();
		$total = $query->total;

		// print_r($total); 

		if ($total != 0) {
			// $total = $total + 1;
			for ($i=1; $i <= $total; $i++) { 
				$data = $this->db->query("
					select * from 
					(select ROW_NUMBER() OVER(ORDER BY idPeserta ASC) AS seq, * from PesertaTender where JobNo = '$JobNo') as a
					where a.seq = $i				
				")->row_object();

				// $value['idPeserta'.$i] = $data->idPeserta;
				$value = [
					'idPeserta'.$i => $data->idPeserta,
				];

				$this->db->where('JobNo', $JobNo);
				$this->db->update('Job', $value);	
			}	
		}

		return $total;

		// $data = $this->db->query("
		// 	select * from PesertaTender where idPeserta = (select max(idPeserta) from PesertaTender where JobNo = '$JobNo')
		// ")->row_object();

		// $value = [
		// 	'idPeserta' => $data->idPeserta,
		// ];

		// $this->db->where('JobNo', $JobNo);
		// return $this->db->update('Job', $value);
	}

	public function insertPesertaTenderMember($data) {
		return $this->db->insert('PesertaTenderMember', $data);
	}

	public function updateProposalTender($data, $IdPeserta) {
		$this->db->where('IdPeserta', $IdPeserta);
		return $this->db->update('PesertaTender', $data);
	}
	
	public function deleteProposalTenderByJobNo($JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->delete('PesertaTender');
	}

	public function deleteProposalLeaderMemberByJobNo($JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->delete('PesertaTender');
	}

	public function updateJob($data, $JobNo) {
		$this->db->where('JobNo', $JobNo);
		return $this->db->update('Job', $data);
	}

	public function getTahapanTenderByJobNo($JobNo) {
		// return $this->db->query("
		// 	SELECT 
		// 	    TahapanTender.*,
		// 	    MasterTahapanTender.id_SisPeng,
		// 	    (
		// 	    	SELECT COUNT(*) FROM EditTahapanTender 
		// 	    	WHERE EditTahapanTender.JobNo = TahapanTender.JobNo 
		// 	    ) AS count
		// 	FROM TahapanTender 
		// 	LEFT JOIN MasterTahapanTender ON MasterTahapanTender.NamaTahapan = TahapanTender.Tahap 
		// 	AND MasterTahapanTender.NamaSistem = TahapanTender.NamaSistem
		// 	WHERE TahapanTender.JobNo = '$JobNo';
		// ")->result_object();

		return $this->db->query("
			select a.LedgerNo, a.JobNo, CONCAT(c.NamaSistem, ' - ', b.NamaTahapan) as Tahap, a.DrTgl, a.SpTgl, a.TimeEntry from TahapanTender as a inner join MasterTahapanTender as b on a.tahap = b.id_tahapan inner join SistemPengadaan as c
			on b.id_SisPeng = c.id_SisPeng where a.JobNo = '$JobNo' order by a.LedgerNo desc;
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
		// $this->db->where('JobNo', $JobNo);
		// return $this->db->get('PesertaTender')->result_object();

		return $this->db->query("
			select idPeserta, JobNo, Leader, PorsiLeader, Member1, PorsiMember1, Member2, PorsiMember2, Member3, PorsiMember3, Member4, PorsiMember4, Member5, PorsiMember5, PenawaranBruto, PenawaranNetto, UserEntry, TimeEntry, cast(cast(Logo as varbinary(max)) as varchar(max)) as Logo from PesertaTender where JobNo = '$JobNo'
		")->result_object();		

	}

	public function getPesertaTenderLeaderByJobNo($JobNo) {
		return $this->db->query("
			select * from PesertaTenderLeader where JobNo = '$JobNo' order by seq
		")->result_object();
	}

	public function getPesertaTenderMemberByJobNo($JobNo) {
		return $this->db->query("
			select a.idLeader, a.jobNo, a.name as leader_name, a.bruto, a.netto, a.porsi as porsi_leader, a.logo, b.name as member_name, b.porsi as porsi_name from PesertaTenderLeader as a inner join PesertaTenderMember as b on b.idLeader = a.idLeader where a.jobNo = '$JobNo' order by a.seq, b.seq
		")->result_object();
	}

	public function getMPPbyJobNo($JobNo) {
		// $this->db->where('JobNo', $JobNo);
		// $this->db->order_by('TimeEntry', 'DESC');
		// return $this->db->get('MPP')->result_object();

		return $this->db->query("
			select CONCAT(a.NIK, ' - ', b.Nama) as Nama, a.Posisi, a.TakeHomePay, a.TimeEntry from mpp as a inner join Karyawan as b on b.nik = a.nik where a.JobNo = '$JobNo' order by a.LedgerNo desc
		")->result_object();		
	}

	public function insertMPP($data) {
		return $this->db->insert('MPP', $data);
	}
}

/* End of file Job.php */
/* Location: ./application/models/Job.php */