<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic extends MY_Controller {

	public function index() {
		redirect('Main');
	}

	// USERS
	public function users($UserID = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('Password')) {
				$data['PasswordCI'] = crypt($this->input->post('Password'), '');
			}
			if ($this->input->post('update')) {
				unset($data['UserID']);
				unset($data['update']);
				$this->users->updateUser($data, $this->input->post('UserID'));
				$this->setMessage('Berhasil','success','Data user berhasil diubah!');
				redirect('Basic/users');
			} else {
				if ($this->users->getUserByUsername($this->input->post('username'))) {
					$this->setMessage('Oppss','error','USER ID Telah terdaftar!');
					redirect('Basic/users');
				}
				$this->users->insertUser($data);
				$this->setMessage('Berhasil','success','Data user berhasil ditambah!');
				redirect('Basic/users');
			}
		} elseif($UserID) {
			$this->users->deleteUser($UserID);
			$this->setMessage('Berhasil','success','Data user berhasil dihapus!');
			redirect('Basic/users');
		} else {
			$this->parseData['title'] = "Data User";
			$this->parseData['content'] = "content/basic/users/list";
			$this->parseData['data'] = $this->users->getUsers();
			$this->load->view('Main', $this->parseData);
		}
	}

	// INSTANSI
	public function instansi($Id_Instansi = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('Id_Instansi')) {
				// UPDATE
				unset($data['Id_Instansi']);
				$this->instansi->updateInstansi($data, $this->input->post('Id_Instansi'));
				$this->setMessage('Berhasil','success','Data instansi berhasil diubah!');
			} else {
				// INSERT
				$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
				$this->instansi->insertInstansi($data);
				$this->setMessage('Berhasil','success','Data instansi berhasil ditambah!');
			}
			redirect('Basic/instansi');
		} else if($Id_Instansi) {
			// DELETE
			$this->instansi->deleteInstansi($Id_Instansi);
			$this->setMessage('Berhasil','success','Data instansi berhasil dihapus!');
			redirect('Basic/instansi');
		} else {
			// VIEW LIST
			$this->parseData['title'] = "Data Instansi";
			$this->parseData['content'] = "content/basic/instansi/instansi";
			$this->parseData['data'] = $this->instansi->getInstansi();
			$this->load->view('Main', $this->parseData);
		}
	}
	public function sub_instansi($Id_Instansi = null, $Id_SubInstansi = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('Id_SubInstansi')) {
				// UPDATE
				unset($data['Id_SubInstansi']);
				$this->instansi->updateSubInstansi($data, $this->input->post('Id_SubInstansi'));
				$this->setMessage('Berhasil','success','Data sub instansi berhasil diubah!');
			} else {
				// INSERT
				$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
				$data['TimeEntry'] = date('Y-m-d');
				$this->instansi->insertSubInstansi($data);
				$this->setMessage('Berhasil','success','Data sub instansi berhasil ditambah!');
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else if($Id_SubInstansi) {
			// DELETE
			$this->instansi->deleteSubInstansi($Id_SubInstansi);
			$this->setMessage('Berhasil','success','Data sub instansi berhasil dihapus!');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			// VIEW LIST
			$instansi = $this->instansi->getInstansiById($Id_Instansi);
			if (!$instansi) {
				redirect('Basic/instansi');
			}
			$this->parseData['instansi'] = $instansi;
			$this->parseData['title'] = "Data Sub Instansi";
			$this->parseData['content'] = "content/basic/instansi/sub_instansi";
			$this->parseData['data'] = $this->instansi->getSubInstansi($Id_Instansi);
			$this->load->view('Main', $this->parseData);
		}
	}

	// TAHAPAN TENDER
	public function tahapan_tender($id_SisPeng = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('id_SisPeng')) {
				// UPDATE
				unset($data['id_SisPeng']);
				$this->tahapanTender->updateMasterTahapan($data, $this->input->post('id_SisPeng'));
				$this->setMessage('Berhasil','success','Data Master Tahapan Tender berhasil diubah!');
			} else {
				// INSERT
				$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
				$this->tahapanTender->insertMasterTahapan($data);
				$this->setMessage('Berhasil','success','Data Master Tahapan Tender berhasil ditambah!');
			}
			redirect('Basic/tahapan_tender');
		} else if($id_SisPeng) {
			// DELETE
			$this->tahapanTender->deleteMasterTahapan($id_SisPeng);
			$this->setMessage('Berhasil','success','Data Master Tahapan Tender berhasil dihapus!');
			redirect('Basic/tahapan_tender');
		} else {
			// VIEW LIST
			$this->parseData['title'] = "Data Master Tahapan Tender";
			$this->parseData['content'] = "content/basic/tahapan_tender/master";
			$this->parseData['data'] = $this->tahapanTender->getMasterTahapan();
			$this->load->view('Main', $this->parseData);
		}
	}
	public function tahapan_detail($id_SisPeng = null, $id_tahapan = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			if ($this->input->post('id_tahapan')) {
				// UPDATE
				unset($data['id_tahapan']);
				$this->tahapanTender->updateTahapanTender($data, $this->input->post('id_tahapan'));
				$this->setMessage('Berhasil','success','Data tahapan tender berhasil diubah!');
			} else {
				// INSERT
				$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
				$data['TimeEntry'] = date('Y-m-d');
				$this->tahapanTender->insertTahapanTender($data);
				$this->setMessage('Berhasil','success','Data tahapan tender berhasil ditambah!');
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else if($id_tahapan) {
			// DELETE
			$this->tahapanTender->deleteTahapanTender($id_tahapan);
			$this->setMessage('Berhasil','success','Data tahapan tender berhasil dihapus!');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			// VIEW LIST
			$master = $this->tahapanTender->getMasterTahapanById($id_SisPeng);
			if (!$master) {
				redirect('Basic/tahapan_tender');
			}
			$this->parseData['master'] = $master;
			$this->parseData['title'] = "Data Tahapan Tender";
			$this->parseData['content'] = "content/basic/tahapan_tender/detail";
			$this->parseData['data'] = $this->tahapanTender->getTahapanTender($id_SisPeng);
			$this->load->view('Main', $this->parseData);
		}
	}

	// INFO PASAR
	public function info_pasar($InfoPasarId = null) {
		if ($InfoPasarId) {
			$this->infoPasar->deleteInfoPasar($InfoPasarId);
			$this->setMessage('Berhasil','success','Data info pasar berhasil dihapus!');
			redirect('Basic/info_pasar');
		} else {
			$data = $this->infoPasar->getInfoPasar();
			foreach ($data as $row => $value) {
				$triwulan = '';
				$month = substr($value->PeriodeTriwulan, 5,2);
				if ($month >= 1 && $month <= 3) {
					$triwulan = 'Triwulan I';
				} elseif ($month >= 4 && $month <= 6) {
					$triwulan = 'Triwulan II';
				} elseif ($month >= 7 && $month <= 9) {
					$triwulan = 'Triwulan III';
				} elseif ($month >= 10 && $month <= 12) {
					$triwulan = 'Triwulan IV';
				}
				$data[$row]->triwulan = $triwulan;
				$data[$row]->periode = $this->dateToPeriode($value->PeriodeTriwulan);
			}
			$this->parseData['title'] = "Data Info Pasar";
			$this->parseData['data'] = $data;
			$this->parseData['content'] = "content/basic/info_pasar/list";
			$this->load->view('Main', $this->parseData);
		}
	}
	public function info_pasar_add() {
		if ($this->input->post()) {
			$data = $this->input->post();
			$instansi = $this->instansi->getInstansiById($this->input->post('NamaInstansi'));
			if ($instansi) {
				$data['NamaInstansi'] = $instansi->NamaDirektorat;
			}
			$subInstansi = $this->instansi->getSubInstansiById($this->input->post('NamaBalai'));
			if ($subInstansi) {
				$data['NamaBalai'] = $subInstansi->NamaSubInstansi;
			}
			$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
			$data['TimeEntry'] = date('Y-m-d H:i:s');
			$data['Company'] = $this->session->userdata('MIS_LOGGED_CORP');
			$oldJob = $this->infoPasar->getLastJobNoByYear(substr(date('Y'), 2,2));
			$jobNo = substr(date('Y'), 2,2).'001';
			if ($oldJob) {
				$runningNumber = substr($oldJob->jobNo, 2);
				$runningNumber++;
				if (strlen($runningNumber) == 1) {
					$jobNo = substr(date('Y'), 2,2).'00'.$runningNumber;
				} elseif (strlen($runningNumber) == 2) {
					$jobNo = substr(date('Y'), 2,2).'0'.$runningNumber;
				} elseif (strlen($runningNumber) == 3) {
					$jobNo = substr(date('Y'), 2,2).$runningNumber;
				}
			}
			$data['jobNo'] = $jobNo;
			$this->infoPasar->insertInfoPasar($data);
			$this->setMessage('Berhasil','success','Data info pasar berhasil ditambahkan!');
			redirect('Basic/info_pasar');
		} else {
			$this->parseData['instansi'] = $this->instansi->getInstansi();
			$this->parseData['title'] = "Tambah Info Pasar";
			$this->parseData['content'] = "content/basic/info_pasar/add";
			$this->load->view('Main', $this->parseData);
		}
	}
	public function info_pasar_edit($InfoPasarId = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			$instansi = $this->instansi->getInstansiById($this->input->post('NamaInstansi'));
			if ($instansi) {
				$data['NamaInstansi'] = $instansi->NamaDirektorat;
			}
			$subInstansi = $this->instansi->getSubInstansiById($this->input->post('NamaBalai'));
			if ($subInstansi) {
				$data['NamaBalai'] = $subInstansi->NamaSubInstansi;
			}
			unset($data['InfoPasarId']);
			$this->infoPasar->updateInfoPasar($data, $this->input->post('InfoPasarId'));
			$this->setMessage('Berhasil','success','Data info pasar berhasil diubah!');
			redirect('Basic/info_pasar');
		} else {
			$data = $this->infoPasar->getInfoPasarById($InfoPasarId);
			if (!$data) {
				redirect('Basic/info_pasar');
			}
			$this->parseData['data'] = $data;
			$this->parseData['instansi'] = $this->instansi->getInstansi();
			$this->parseData['title'] = "Ubah Info Pasar";
			$this->parseData['content'] = "content/basic/info_pasar/edit";
			$this->load->view('Main', $this->parseData);
		}
	}
	public function info_pasar_mpp($InfoPasarId = null, $LedgerNo = null) {
		if ($this->input->post()) {
			$data = $this->input->post();
			$karyawan = $this->input->post('karyawan');
			unset($data['karyawan']);
			$arr = explode('-', $karyawan);
			if (isset($arr[0]) && isset($arr[1])) {
				$data['NIK'] = $arr[0];
				$data['Nama'] = $arr[1];
			}
			$data['TakeHomePay'] = str_replace(',', '', $data['TakeHomePay']);
			if ($this->input->post('LedgerNo')) {
				unset($data['LedgerNo']);
				$this->infoPasar->updateMpp($data, $this->input->post('LedgerNo'));
				$this->setMessage('Berhasil','success','Data MPP berhasil diubah!');
			} else {
				$data['UserEntry'] = $this->session->userdata('MIS_LOGGED_NAME');
				$data['TimeEntry'] = date('Y-m-d H:i:s');
				$this->infoPasar->insertMpp($data);
				$this->setMessage('Berhasil','success','Data MPP berhasil ditambahkan!');
			}
			redirect($_SERVER['HTTP_REFERER']);
		} elseif($LedgerNo) {
			$this->infoPasar->deleteMpp($LedgerNo);
			$this->setMessage('Berhasil','success','Data MPP berhasil dihapus!');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$info_pasar = $this->infoPasar->getInfoPasarById($InfoPasarId);
			if (!$info_pasar) {
				redirect('Basic/info_pasar');
			}
			$this->parseData['info_pasar'] = $info_pasar;
			$this->parseData['posisi'] = $this->posisi;
			$this->parseData['karyawan'] = $this->karyawan->getKaryawan_SIMPLE();
			$this->parseData['data'] = $this->infoPasar->getMppByInfoPasar($InfoPasarId);
			$this->parseData['title'] = "List Man Power Planning Pada Info Pasar: ".$info_pasar->NamaPaket;
			$this->parseData['content'] = "content/basic/info_pasar/mpp";
			$this->load->view('Main', $this->parseData);
		}
	}

	// PROPOSAL
	public function proposal() {
		$this->parseData['title'] = "Data Proposal";
		$this->parseData['posisi'] = $this->posisi;
		$this->parseData['karyawan'] = $this->karyawan->getKaryawan_SIMPLE();
		$this->parseData['sistemPengadaan'] = $this->tahapanTender->getMasterTahapan();
		$this->parseData['content'] = "content/basic/proposal/list";
		$this->load->view('Main', $this->parseData);
	}
	public function listProposal() {
		$columns = [
			0 => 'JobNo',
			1 => 'JobNm',
			2 => 'Provinsi',
			3 => 'Instansi',
			4 => 'HPS',
			5 => 'StatusJob',
			6 => 'tahapanTender',
			7 => 'actions',
		];
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = (isset($columns[$this->input->post('order')[0]['column']]) ? $columns[$this->input->post('order')[0]['column']] : 'TimeEntry');
		$dir = ($this->input->post('order')[0]['dir'] ? $this->input->post('order')[0]['dir'] : 'desc');
		$totalData = $this->job->getAllCount()->count;
		$totalFiltered = $totalData;
		if (empty($this->input->post('search')['value'])) {
			$posts = $this->job->getAllData($limit, $start, $order, $dir);
		} else {
			$search = $this->input->post('search')['value'];
			$posts =  $this->job->getAllData_search($limit, $start, $search, $order, $dir);
			$totalFiltered = $this->job->getAllCount_search($search)->count;
		}
		$data = array();
		if (!empty($posts)) {
			foreach ($posts as $post) {
				// ACTIONS
				$actions = '<a title="Edit Proposal" href="'.site_url('Basic/proposal_edit/'.$post->JobNo).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
				$actions .= '<button type="button" title="Tahapan tender" onclick="openTahapan(\''.$post->JobNo.'\')" class="btn btn-info"><i class="fa fa-cubes"></i></button>';
				$actions .= '<button type="button" title="Hasil Pembukaan" onclick="openPembukaan(\''.$post->JobNo.'\')" class="btn btn-warning"><i class="fa fa-book"></i></button>';
				$actions .= '<button type="button" title="Man Power Planning" onclick="openMPP(\''.$post->JobNo.'\',\''.$post->JobNo.'\')" class="btn btn-primary"><i class="fa fa-users"></i></button>';
				$actions .= '<button type="button" title="Menang" onclick="openWinner(\''.$post->JobNo.'\')" class="btn btn-success"><i class="fa fa-trophy"></i></button>';
				$actions .= '<button type="button" title="Gagal" onclick="openFailure(\''.$post->JobNo.'\')" class="btn btn-danger"><i class="fa fa-times"></i></button>';
				
				// NESTED
				$tahapanTender = '-';
				$dataTahapan = $this->job->getTahapanTenderByJobNo_SINGLE($post->JobNo);
				if ($dataTahapan) {
					$tahapanTender = $dataTahapan->Tahap;
				}
				$nestedData['JobNo'] = $post->JobNo;
				$nestedData['JobNm'] = $post->JobNm;
				$nestedData['Provinsi'] = $post->Provinsi;
				$nestedData['Instansi'] = $post->Instansi;
				$nestedData['HPS'] = number_format($post->HPS);
				$nestedData['StatusJob'] = $post->StatusJob;
				$nestedData['TahapanTender'] = $tahapanTender;
				$nestedData['actions'] = $actions;
				$data[] = $nestedData;
			}
		}
		$json_data = [
			"sEcho"            => intval($this->input->post('draw')),
			"iTotalRecords"    => intval($totalData),
			"iTotalDisplayRecords" => intval($totalFiltered),
			"aaData"            => $data
		];
		echo json_encode($json_data);
	}
	public function proposal_add() {
		if ($this->input->post()) {
			// CHECK AVAILABLE JOBNO
			if ($this->job->getJobByJobNo($this->input->post('JobNo'))) {
				$this->setMessage('Ooppss','warning', 'Job No sudah terdaftar, silahkan coba job lain');
				redirect('Basic/proposal_add');
			}
			// END
			$job = [
				'JobNo' => $this->input->post('JobNo'),
				'JobNm' => $this->input->post('JobNm'),
				'TipeJob' => 'PROJECT',
				'Lokasi' => $this->input->post('Lokasi'),
				'Instansi' => $this->input->post('Instansi'),
				'InfoPasarId' => $this->input->post('InfoPasarId'),
				'Provinsi' => $this->input->post('Provinsi'),
				'Deskripsi' => $this->input->post('LingkupPekerjaan'),
				'KSO' => ($this->input->post('PesertaTender') == 'KSO' ? 1 : 0),
				'SumberDana' => $this->input->post('SumberDana'),
				'TipePekerjaan' => $this->input->post('TipePekerjaan'),
				'TahunAnggaran' => $this->input->post('TahunAnggaran'),
				'Peluang' => $this->input->post('Peluang'),
				'HPS' => str_replace(',', '', $this->input->post('HPS')),
				'SistemKontrak' => $this->input->post('SistemKontrak'),
				'TglKontrak' => $this->input->post('RencanaTender'),
				'StatusJob' => 'Proposal',
				'SistemKontrak' => $this->input->post('SistemKontrak'),
				'TimeEntry' => date('Y-m-d H:i:s'),
				'UserEntry' => $this->session->userdata('MIS_LOGGED_NAME'),
				'Company' => $this->session->userdata('MIS_LOGGED_CORP'),
			];
			$this->uploadFileConf('jobs',true);
			if ($_FILES['RAPfile']['name']) {
				if ($_FILES['RAPfile']['type'] != 'application/pdf') {
					$this->setMessage('Ooppss','warning', 'RAP File harus menggunakan .pdf');
					redirect($_SERVER['HTTP_REFERER']);
				}
				if (!$this->upload->do_upload('RAPfile')){
					$this->setMessage('Ooppss','warning', strip_tags($this->upload->display_errors()));
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$job['RAPFile'] = $this->upload->data()['file_name'];
				}
			}
			$this->job->insertProposal($job);
			for ($i=1; $i <= $this->input->post('totalTender'); $i++) { 
				if ($this->input->post('leader'.$i)) {
					$pesertaTender = [
						'JobNo' => $this->input->post('JobNo'),
						'Leader' => $this->input->post('leader'.$i),
						'PorsiLeader' => $this->input->post('leaderPorsi'.$i),
						'PenawaranBruto' => str_replace(',', '', $this->input->post('PenawaranBruto'.$i)),
						'PenawaranNetto' => str_replace(',', '', $this->input->post('PenawaranNetto'.$i)),
						'TimeEntry' => date('Y-m-d H:i:s'),
						'UserEntry' => $this->session->userdata('MIS_LOGGED_NAME'),
					];
					if ($this->input->post('totalMember'.$i)) {
						for ($b=1; $b <= $this->input->post('totalMember'.$i); $b++) { 
							if ($this->input->post('member-'.$i.'-'.$b)) {
								$pesertaTender['Member'.$b] = $this->input->post('member-'.$i.'-'.$b);
								$pesertaTender['PorsiMember'.$b] = $this->input->post('memberPorsi-'.$i.'-'.$b);
							}
						}
					}
					if ($_FILES['tenderLogo'.$i]['name']) {
						if (!$this->upload->do_upload('tenderLogo'.$i)){
							$this->setMessage('Ooppss','warning', strip_tags($this->upload->display_errors()));
							redirect($_SERVER['HTTP_REFERER']);
						} else {
							$pesertaTender['logo'] = $this->upload->data()['file_name'];
						}
					}
					$this->job->insertProposalTender($pesertaTender);
				}
			}
			$this->setMessage('Berhasil','success','Data proposal berhasil ditambahkan!');
			redirect('Basic/proposal');
		} else {
			$this->parseData['infoPasar'] = $this->infoPasar->getInfoPasar_SIMPLE();
			$this->parseData['pesertaTender'] = json_encode($this->pesertaTender);
			$this->parseData['provinces'] = $this->provinces;
			$this->parseData['title'] = "Tambah Proposal";
			$this->parseData['content'] = "content/basic/proposal/add";
			$this->load->view('Main', $this->parseData);
		}
	}
	public function proposal_edit($JobNo = null) {
		if ($this->input->post()) {
			$job = [
				'JobNm' => $this->input->post('JobNm'),
				'TipeJob' => 'PROJECT',
				'Lokasi' => $this->input->post('Lokasi'),
				'Instansi' => $this->input->post('Instansi'),
				'InfoPasarId' => $this->input->post('InfoPasarId'),
				'Provinsi' => $this->input->post('Provinsi'),
				'Deskripsi' => $this->input->post('LingkupPekerjaan'),
				'KSO' => ($this->input->post('PesertaTender') == 'KSO' ? 1 : 0),
				'SumberDana' => $this->input->post('SumberDana'),
				'TipePekerjaan' => $this->input->post('TipePekerjaan'),
				'TahunAnggaran' => $this->input->post('TahunAnggaran'),
				'Peluang' => $this->input->post('Peluang'),
				'HPS' => str_replace(',', '', $this->input->post('HPS')),
				'SistemKontrak' => $this->input->post('SistemKontrak'),
				'TglKontrak' => $this->input->post('RencanaTender'),
				'StatusJob' => 'Proposal',
				'SistemKontrak' => $this->input->post('SistemKontrak'),
			];
			$this->uploadFileConf('jobs',true);
			if ($_FILES['RAPfile']['name']) {
				if ($_FILES['RAPfile']['type'] != 'application/pdf') {
					$this->setMessage('Ooppss','warning', 'RAP File harus menggunakan .pdf');
					redirect($_SERVER['HTTP_REFERER']);
				}
				if (!$this->upload->do_upload('RAPfile')){
					$this->setMessage('Ooppss','warning', strip_tags($this->upload->display_errors()));
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$job['RAPFile'] = $this->upload->data()['file_name'];
				}
			}
			$this->job->updateJob($job, $this->input->post('JobNo'));
			$this->job->deleteProposalTenderByJobNo($this->input->post('JobNo'));
			for ($i=1; $i <= $this->input->post('totalTender'); $i++) { 
				if ($this->input->post('leader'.$i)) {
					$pesertaTender = [
						'JobNo' => $this->input->post('JobNo'),
						'Leader' => $this->input->post('leader'.$i),
						'PorsiLeader' => $this->input->post('leaderPorsi'.$i),
						'PenawaranBruto' => str_replace(',', '', $this->input->post('PenawaranBruto'.$i)),
						'PenawaranNetto' => str_replace(',', '', $this->input->post('PenawaranNetto'.$i)),
						'TimeEntry' => date('Y-m-d H:i:s'),
						'UserEntry' => $this->session->userdata('MIS_LOGGED_NAME'),
					];
					if ($this->input->post('totalMember'.$i)) {
						for ($b=1; $b <= $this->input->post('totalMember'.$i); $b++) { 
							if ($this->input->post('member-'.$i.'-'.$b)) {
								$pesertaTender['Member'.$b] = $this->input->post('member-'.$i.'-'.$b);
								$pesertaTender['PorsiMember'.$b] = $this->input->post('memberPorsi-'.$i.'-'.$b);
							}
						}
					}
					if ($_FILES['tenderLogo'.$i]['name']) {
						if (!$this->upload->do_upload('tenderLogo'.$i)){
							$this->setMessage('Ooppss','warning', strip_tags($this->upload->display_errors()));
							redirect($_SERVER['HTTP_REFERER']);
						} else {
							$pesertaTender['logo'] = $this->upload->data()['file_name'];
						}
					} else {
						$pesertaTender['logo'] = $this->input->post('logo'.$i);
					}
					$this->job->insertProposalTender($pesertaTender);
				}
			}
			$this->setMessage('Berhasil','success','Data proposal berhasil diubah!');
			redirect('Basic/proposal');
		} else {
			$data = $this->job->getJobByJobNo($JobNo);
			if (!$data) {
				redirect('Basic/proposal');
			}
			$peserta = $this->job->getPesertaTenderByJobNo($JobNo);
			foreach ($peserta as $row => $value) {
				$peserta[$row]->PenawaranBruto = $this->removeDecimal($value->PenawaranBruto);
				$peserta[$row]->PenawaranNetto = $this->removeDecimal($value->PenawaranNetto);
				$peserta[$row]->PorsiLeader = $this->removeDecimal($value->PorsiLeader);
				$peserta[$row]->PorsiMember1 = $this->removeDecimal($value->PorsiMember1);
				$peserta[$row]->PorsiMember2 = $this->removeDecimal($value->PorsiMember2);
				$peserta[$row]->PorsiMember3 = $this->removeDecimal($value->PorsiMember3);
				$peserta[$row]->PorsiMember4 = $this->removeDecimal($value->PorsiMember4);
				$peserta[$row]->PorsiMember5 = $this->removeDecimal($value->PorsiMember5);
			}
			$data->peserta = $peserta;
			$this->parseData['data'] = $data;
			$this->parseData['infoPasar'] = $this->infoPasar->getInfoPasar_SIMPLE();
			$this->parseData['pesertaTender'] = json_encode($this->pesertaTender);
			$this->parseData['provinces'] = $this->provinces;
			$this->parseData['title'] = "Ubah Proposal";
			$this->parseData['content'] = "content/basic/proposal/edit";
			$this->load->view('Main', $this->parseData);
		}
	}
	public function proposal_winner() {
		if ($this->input->post()) {
			$this->job->updateJob([
				'StatusJob' => 'Pelaksanaan',
				'Company' => $this->input->post('company')
			], $this->input->post('JobNo'));
		}
		redirect('Basic/proposal');
	}
	public function proposal_failure() {
		if ($this->input->post()) {
			$this->job->updateJob([
				'StatusJob' => 'Gagal',
				'AlasanGugur' => $this->input->post('AlasanGugur'),
				'CompanyId' => $this->input->post('PemenangLelang'),
				'PenawaranPemenang' => str_replace(',', '', $this->input->post('PenawaranPemenang'))
			], $this->input->post('JobNo'));
		}
		redirect('Basic/proposal');
	}
	public function proposal_pembukaan() {
		if ($this->input->post()) {
			$this->uploadFileConf('jobs');
			if (!$this->upload->do_upload('HasilPembukaan')){
				$this->setMessage('Ooppss','warning', strip_tags($this->upload->display_errors()));
			} else {
				$this->job->updateJob([
					'HasilPembukaan' => $this->upload->data()['file_name']
				], $this->input->post('JobNo'));
				$this->setMessage('Berhasil','success','Data pembukaan pada proposal berhasil disimpan!');
			}
		}
		redirect('Basic/proposal');
	}

	// JOB
	public function job() {
		$this->parseData['title'] = "Data Job";
		$this->parseData['content'] = "content/basic/job/list";
		$this->load->view('Main', $this->parseData);
	}
	public function listJob() {
		$columns = [
			0 => 'JobNo',
			1 => 'JobNm',
			2 => 'Deskripsi',
			3 => 'Kontraktor',
			5 => 'StatusJob',
			6 => 'Kategori',
			7 => 'actions',
		];
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = (isset($columns[$this->input->post('order')[0]['column']]) ? $columns[$this->input->post('order')[0]['column']] : 'TimeEntry');
		$dir = ($this->input->post('order')[0]['dir'] ? $this->input->post('order')[0]['dir'] : 'desc');
		$totalData = $this->job->getAllCount()->count;
		$totalFiltered = $totalData;
		if (empty($this->input->post('search')['value'])) {
			$posts = $this->job->getAllData($limit, $start, $order, $dir);
		} else {
			$search = $this->input->post('search')['value'];
			$posts =  $this->job->getAllData_search($limit, $start, $search, $order, $dir);
			$totalFiltered = $this->job->getAllCount_search($search)->count;
		}
		$data = array();
		if (!empty($posts)) {
			foreach ($posts as $post) {
				// ACTIONS
				$actions = '<a title="Open Job Form" href="'.site_url('Basic/job_form/'.$post->JobNo).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
				// NESTED
				$kontraktor = '-';
				$dataPeserta = $this->job->getPesertaTenderByJobNo_SINGLE_ARR($post->JobNo);
				if ($dataPeserta) {
					$kontraktor = '(L)'.$dataPeserta['Leader'];
					foreach (range(1,5) as $r => $v) {
						if ($dataPeserta['Member'.$v]) {
							$kontraktor .= ' - '.$dataPeserta['Member'.$v];
						}
					}
				}
				$nestedData['JobNo'] = $post->JobNo;
				$nestedData['JobNm'] = $post->JobNm;
				$nestedData['Deskripsi'] = $post->Deskripsi;
				$nestedData['Kontraktor'] = $kontraktor;
				$nestedData['StatusJob'] = $post->StatusJob;
				$nestedData['Kategori'] = $post->Kategori;
				$nestedData['actions'] = $actions;
				$data[] = $nestedData;
			}
		}
		$json_data = [
			"sEcho"            => intval($this->input->post('draw')),
			"iTotalRecords"    => intval($totalData),
			"iTotalDisplayRecords" => intval($totalFiltered),
			"aaData"            => $data
		];
		echo json_encode($json_data);
	}
}

/* End of file Basic.php */
/* Location: ./application/controllers/Basic.php */