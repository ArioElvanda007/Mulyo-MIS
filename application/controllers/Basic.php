<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic extends MY_Controller {

	public function index() {
		redirect('Main');
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
			6 => 'actions',
		];
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = (isset($columns[$this->input->post('order')[0]['column']]) ? $columns[$this->input->post('order')[0]['column']] : 'JobNo');
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
				$actions = '<a href="'.site_url('Basic/proposal_edit/'.$post->JobNo).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>';
				$actions .= '<a title="Tahapan tender" href="'.site_url('Basic/proposal_tahapan/'.$post->JobNo) .'" class="btn btn-info"><i class="fa fa-cubes"></i></a>';
				$actions .= '<a title="Hasil Pembukaan" href="'.site_url('Basic/proposal_pembukaan/'.$post->JobNo).'" class="btn btn-warning"><i class="fa fa-book"></i></a>';
				$actions .= '<a title="Menang" href="'.site_url('Basic/proposal_menang/'.$post->JobNo).'" class="btn btn-success"><i class="fa fa-trophy"></i></a>';
				$actions .= '<a title="Gagal" href="'.site_url('Basic/proposal_gagal/'.$post->JobNo).'" class="btn btn-danger"><i class="fa fa-times"></i></a>';
				
				// NESTED
				$nestedData['JobNo'] = $post->JobNo;
				$nestedData['JobNm'] = $post->JobNm;
				$nestedData['Provinsi'] = $post->Provinsi;
				$nestedData['Instansi'] = $post->Instansi;
				$nestedData['HPS'] = number_format($post->HPS);
				$nestedData['StatusJob'] = $post->StatusJob;
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

	}
	public function proposal_edit() {
		
	}

}

/* End of file Basic.php */
/* Location: ./application/controllers/Basic.php */