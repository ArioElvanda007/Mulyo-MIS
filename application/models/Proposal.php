<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Model {

    public function data_job()
    {
        // $query = $this->db->query("SELECT * From Job WHERE statusjob = 'Proposal' AND company = 'PRA' ORDER BY JobNo DESC");
        // return $query;

        $query = $this->db->query("
            select ax.JobNo, ax.JobNm, ax.Provinsi, ax.Instansi, ax.HPS, 
            (select CONCAT(c.NamaSistem, ' - ', b.NamaTahapan) from TahapanTender as a inner join MasterTahapanTender as b on a.tahap = b.id_tahapan inner join SistemPengadaan as c
            on b.id_SisPeng = c.id_SisPeng where a.JobNo = ax.JobNo and a.LedgerNo = (select max(LedgerNo) from TahapanTender where JobNo = ax.JobNo)) as Tahap, 
            case
                when ax.HasilPembukaan is null then 'None'
                else ax.HasilPembukaan
            end as HasilPembukaan
            , ax.InfoPasarId, (select CONCAT(a.NIK, ' - ', b.Nama, ' (', a.Posisi, '), Take Homepay : ',a.TakeHomePay) as Nama from mpp as a inner join Karyawan as b on b.nik = a.nik where a.LedgerNo = (select max(LedgerNo) from MPP where InfoPasarId = ax.InfoPasarId and JobNo = ax.JobNo)) as manPower,
            case
                when ax.Logo is null then 'images/camera.png'
                else REPLACE(ax.Logo, '~/Images', 'images')
            end as Logo, ax.TimeEntry, ax.Deskripsi, ax.Lokasi
            from
            (SELECT * From Job WHERE statusjob = 'Proposal' AND company = 'PRA') as ax ORDER BY ax.JobNo DESC  
        ");
        return $query;        
    }	

    public function dataSistemPengadaan()
    {
        $query = $this->db->query("select * from SistemPengadaan");
        return $query;
    }	

    public function posisiKaryawan()
    {
        $query = $this->db->query("
            select PositionName as posisi from JobPosition group by PositionName            
        ");
        return $query;        
    }    

}

/* End of file Proposal.php */
/* Location: ./application/models/Proposal.php */