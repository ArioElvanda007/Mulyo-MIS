<style type="text/css">
    table tbody tr td button {
        margin-left: 5px;
    }
</style>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Data Proposal</h1>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<a href="<?= site_url('Basic/proposal_add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						<br /><br />

                        <div>
                            <table id="datatable_nosort" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>List of proposal</th>
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                        foreach ($data_job as $j => $value) : ?>
                                            <tr>
                                                <td>
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <a href="<?php echo base_url('Basic/proposal_edit/' . $value->JobNo); ?>">
                                                                <img class="img-circle img-bordered-sm" src=<?=base_url('assets/'.$value->Logo)?> alt="Logo instansi">
                                                            </a>                                                            

                                                            <span class="username">
                                                                <a href="<?php echo base_url('Basic/proposal_edit/' . $value->JobNo); ?>">
                                                                    <i class="fa fa-edit mr-1"></i><?= $value->JobNo; ?>
                                                                </a>
                                                            </span>

                                                            <span class="description">Shared publicly - <?= $value->TimeEntry; ?></span>
                                                        </div>

                                                        <div>
                                                            <a href="<?php echo base_url('Basic/proposal_edit/' . $value->JobNo); ?>">
                                                                <h2 class="lead px-5">
                                                                    <i class="fa fa-edit mr-1"></i>
                                                                    <b>Project : <?= $value->JobNo; ?> ~ <?= $value->JobNm; ?></b>
                                                                </h2>
                                                            </a>

                                                            <ul class="mb-0 text-muted px-5 ml-4">
                                                                <li class="medium">Agency : <?= $value->Instansi; ?></li>
                                                                <li class="medium">Province : <?= $value->Provinsi; ?> - <?= $value->Lokasi; ?></li>
                                                                <li class="medium">HPS : <?= number_format($value->HPS); ?></li>
                                                                <li class="medium">Step : <?= $value->Tahap; ?></li>
                                                                <li class="medium">MPP : <?= $value->manPower; ?></li>
                                                                <li class="medium">Description : <?= $value->Deskripsi; ?></li>
                                                            </ul>

                                                            <p class="px-5">
                                                                <a href="<?=base_url('assets/files/jobs/'.$value->HasilPembukaan)?>"  target="_blank"><i class="fas fa-link mr-1"></i>Opening result file : <?= $value->HasilPembukaan; ?></a>
                                                            </p>                                                            
                                                        </div>

                                                        <div class="px-5">
                                                            <button type="button" class="btn bg-teal"
                                                                data-toggle="modal"
                                                                data-myjobno=<?= $value->JobNo; ?> 
                                                                data-target="#tahapan-tender"
                                                            >
                                                                <i class="fa fa-cubes"></i>
                                                                Tender stages                                                      
                                                            </button>                                                    

                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-myjobno=<?= $value->JobNo; ?> 
                                                                data-myinfopasarid=<?= $value->InfoPasarId; ?> 
                                                                data-target="#power-planning"
                                                            >
                                                                <i class="fa fa-users"></i>
                                                                MPP                                                      
                                                            </button>                                                    
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        <?php
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MODALS tahapan-tender-->
<div class="modal fade" id="tahapan-tender">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Entry tahapan tender
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <p>One fine body&hellip;</p> -->
                <form action="#" method="POST" id="formEntryTahapanTender">
                    <input type="hidden" name="JobNo" id="JobNo">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama Sistem Pengadaan</label>
                                <select class="form-control" id="sistemPengadaan" onchange="changeSistemPengadaan()">
                                    <?php foreach ($dataSistemPengadaan as $row => $value): ?>
                                        <option value="<?= $value->id_SisPeng ?>"><?= $value->NamaSistem ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="labelTahapanTender">Nama Tahapan Tender</label>
                                <select class="form-control" id="Tahap" name="Tahap"></select>
                            </div>  
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="DrTgl" id="DrTgl">
                            </div>
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="SpTgl" id="SpTgl">
                            </div>
                        </div>
                    </div><!-- / ROW -->
                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-primary" id="buttonTahapanTender" onclick="saveTahapan(this)">Save changes</button>
                    </div>
                </form>
                
                <br />
                <p style="float: right;margin: 0;font-size: 20px">Revisi: <span id="totalTahapanEdited"></span></p>
                <legend>
                    List Tahapan Tender
                </legend>
                <br />
                <table id="datatable2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th>Nama Tahapan Tender</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                            <th>Time Entry</th>
                            <!-- <th>Aksi</th> -->
                        </tr>                                
                    </thead>
                    <tbody id="appendTahapanTenderList"></tbody>
                </table>
                <br />

            </div>
            <!-- <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-primary" id="buttonTahapanTender" onclick="saveTahapan(this)">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- MODALS power-planning-->
<div class="modal fade" id="power-planning">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Man power planning
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formMPP">
                    <input type="hidden" name="JobNo" id="JobNo">
                    <input type="hidden" name="InfoPasarId" id="InfoPasarId">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Karyawan</label>
                                <select class="form-control" id="NIK" name="NIK">
                                    <?php foreach ($karyawan as $row => $value): ?>
                                        <option value="<?= $value->NIK ?>"><?= $value->NIK.' - '.$value->Nama ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">

                            </div>  
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Posisi</label>
                                <select class="form-control" id="posisi" name="posisi">
                                    <?php foreach ($posisiKaryawan as $row => $value): ?>
                                        <option value="<?= $value->posisi ?>"><?= $value->posisi ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Take Home Pay</label>
                                <input type="text" onkeyup="toDecimal(this)" class="form-control" required name="TakeHomePay" id="TakeHomePay">
                            </div>  
                        </div>

                    </div>
                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-primary" onclick="saveMPP(this)">Save changes</button>
                    </div>
                </form>
                
                <br />
                <p style="float: right;margin: 0;font-size: 20px">Revisi: <span id="totalTahapanEdited"></span></p>
                <legend>
                    List Tahapan Tender
                </legend>
                <br />
                <table id="datatable3" class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th>Karyawan</th>
                            <th>Posisi</th>
                            <th>Take Home Pay (Rp)</th>
                            <th>Time Entry</th>
                        </tr>
                    </thead>
                    <tbody id="appendMPPlist"></tbody>
                </table>
                <br />

            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<div class="modal fade" id="winner">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Winner Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('Basic/proposal_winner') ?>" method="POST">
                    <input type="hidden" name="JobNo" id="JobNo">
                    <div class="form-group">
                        <label>Pilih Pemenang</label>
                        <select class="form-control" name="company">
                            <option value="MDH">MINARTA</option>
                            <option value="KIP">KELMAN INFRA</option>
                            <option value="DLL">DLL</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="failure">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Untuk gagal Tender</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('Basic/proposal_failure') ?>" method="POST">
                    <input type="hidden" name="JobNo" id="JobNo_failure">
                    <div class="form-group">
                        <label>Alasan Gugur</label>
                        <textarea class="form-control" name="AlasanGugur"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Pemenang Lelang</label>
                        <input type="text" class="form-control" name="PemenangLelang">
                    </div>
                    <div class="form-group">
                        <label>Penawaran Lelang</label>
                        <input type="text" class="form-control" name="PenawaranPemenang" onkeyup="toDecimal(this)">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="tahapanTender">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Entry Tahapan Tender</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formEntryTahapanTender">
                    <input type="hidden" name="JobNo" id="JobNo_tahapanTender" value="0">
                    <input type="hidden" name="LedgerNo" id="LedgerNo" value="0">
                    <input type="hidden" name="NamaSistem" id="NamaSistem" value="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama Sistem Pengadaan</label>
                                <select class="form-control" id="sistemPengadaan" onchange="changeSistemPengadaan()">
                                    <?php foreach ($sistemPengadaan as $row => $value): ?>
                                        <option value="<?= $value->id_SisPeng ?>"><?= $value->NamaSistem ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label id="labelTahapanTender">Nama Tahapan Tender</label>
                                <select class="form-control" id="Tahap" name="Tahap"></select>
                            </div>  
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="DrTgl" id="DrTgl">
                            </div>
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="SpTgl" id="SpTgl">
                            </div>
                        </div>
                    </div><!-- / ROW -->
                    <button class="btn btn-primary" id="buttonTahapanTender" type="button" onclick="saveTahapan(this)">Simpan</button>
                </form>
                <br />
                <p style="float: right;margin: 0;font-size: 20px">Revisi: <span id="totalTahapanEdited"></span></p>
                <legend>
                    List Tahapan Tender
                </legend>
                <br />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">No. Urut</th>
                            <th>Nama Tahapan Tender</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                            <th>Time Entry</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody id="appendTahapanTenderList"></tbody>
                </table>
                <br />
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="pembukaan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informasi Hasil Pembukaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="url-pembukaan" style="text-align: center;"></div>
                <form action="<?= site_url('Basic/proposal_pembukaan') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="JobNo" id="JobNo_pembukaan">
                    <label id="labelUploadFile">File Hasil Pembukaan (.png atau .jpg)</label>
                    <div class="imagePreview" id="form-pembukaan">
                        <input type="file" class="upload" name="HasilPembukaan" required onchange="preview(this)">
                    </div>
            </div>
            <div class="modal-footer" id="footer-pembukaan">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="mpp">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Man Power Planning</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formMPP">
                    <input type="hidden" name="JobNo" id="JobNo_mpp">
                    <input type="hidden" name="InfoPasarId" id="InfoPasarId_mpp">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Karyawan*</label>
                                <select class="form-control select2" name="karyawan">
                                    <?php foreach ($karyawan as $r => $v): ?>
                                        <option value="<?= $v->NIK.'-'.$v->Nama ?>"><?= $v->NIK.' - '.$v->Nama ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Posisi*</label>
                                <select class="form-control select2" name="Posisi">
                                    <?php foreach ($posisi as $r => $v): ?>
                                        <option value="<?= $v ?>"><?= $v ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Take Home Pay*</label>
                                <input type="text" onkeyup="toDecimal(this)" class="form-control" required name="TakeHomePay" id="TakeHomePay">
                            </div>
                        </div>
                    </div><!-- / ROW -->
                    <button class="btn btn-primary" type="button" onclick="saveMPP(this)">Simpan</button>
                </form>
                <br />
                <legend>List Man Power</legend>
                <br />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">No. Urut</th>
                            <th>Nama Karyawan</th>
                            <th>Posisi</th>
                            <th>Take Home Pay (Rp)</th>
                            <th>Time Entry</th>
                        </tr>
                    </thead>
                    <tbody id="appendMPPlist"></tbody>
                </table>
                <br />
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END -->

<script type="text/javascript">          
  $('#tahapan-tender').on('show.bs.modal', function(event){// #edit_akses adalah id yang ada di form modal edit
    var button = $(event.relatedTarget)
    var val_myjobno = button.data('myjobno')// myJobNo adalah data-myJobNo yang ada di form modal edit

    // mengisi value yang ada di div modal-body
    var modal = $(this)
    // modal-body adalah <div class="modal-body"> yang ada di form modal edit
    modal.find('.modal-body #JobNo').val(val_myjobno);// #id adalah id dari input type yang ada di form modal edit

    $.ajax({
        url: '<?= site_url("Ajax/getTahapanTenderByJobNo/") ?>'+val_myjobno,
        type: 'GET',
        success:function(res) {
            var _html = '';
            var totalTahapanEdited = 0;
            $.each($.parseJSON(res), function(i,v) {
                if(i == 0) $("#totalTahapanEdited").html(v.count);
                _html += '<tr>';
                    _html += '<td>'+(i + 1)+'</td>';
                    _html += '<td>'+v.Tahap+'</td>';
                    _html += '<td>'+v.DrTgl_toPeriode+'</td>';
                    _html += '<td>'+v.SpTgl_toPeriode+'</td>';
                    _html += '<td>'+v.TimeEntry+'</td>';
                _html += '</tr>';
            });
            $("#appendTahapanTenderList").html(_html);
            setLoading();
            changeSistemPengadaan();
        }
    })

  })

  $('#power-planning').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var val_myjobno = button.data('myjobno')
    var val_myinfopasarid = button.data('myinfopasarid')

    var modal = $(this)
    modal.find('.modal-body #JobNo').val(val_myjobno);
    modal.find('.modal-body #InfoPasarId').val(val_myinfopasarid);

    $.ajax({
        url: '<?= site_url("Ajax/getMPPbyJobNo/") ?>'+val_myjobno,
        type: 'GET',
        success:function(res) {
            var _html = '';
            var totalTahapanEdited = 0;
            $.each($.parseJSON(res), function(i,v) {
                _html += '<tr>';
                    _html += '<td>'+(i + 1)+'</td>';
                    _html += '<td>'+v.Nama+'</td>';
                    _html += '<td>'+v.Posisi+'</td>';
                    _html += '<td>'+v.TakeHomePay+'</td>';
                    _html += '<td>'+v.TimeEntry+'</td>';
                _html += '</tr>';
            });
            $("#appendMPPlist").html(_html);
            setLoading();
        }
    })

  })  

    $(function() {
        genTable();
    })
    function genTable() {
        $("#datatable_serverside").dataTable().fnDestroy()
        table = $('#datatable_serverside').DataTable({
            "processing": true,
            "serverSide": true,
            "bLengthChange": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('Basic/listProposal') ?>",
                "type": "POST",
            },
            "columns": [{
                    "data": "JobNo"
                },
                {
                    "data": "JobNm"
                },
                {
                    "data": "Provinsi"
                },
                {
                    "data": "Instansi"
                },
                {
                    "data": "HPS"
                },
                {
                    "data": "StatusJob"
                },
                {
                    "data": "TahapanTender"
                },
                {
                    "data": "actions"
                }
            ],
            "columnDefs": [{
                "targets": [6,7],
                "orderable": false
            }, {
            	width: '25%', targets: 7
            }]
        });
    }
    function openWinner(JobNo = null) {
        if (JobNo) {
            $("#winner").modal('show');
            $("#JobNo").val(JobNo);
        }
    }
    function openFailure(JobNo = null) {
        if (JobNo) {
            $("#failure").modal('show');
            $("#JobNo_failure").val(JobNo);
        }
    }
    function openTahapan(JobNo = null, openModal = true) {
        if (JobNo) {
            $("#JobNo_tahapanTender").val(JobNo);
            setLoading(true);
            $.ajax({
                url: '<?= site_url("Ajax/getTahapanTenderByJobNo/") ?>'+JobNo,
                type: 'GET',
                success:function(res) {
                    var _html = '';
                    var totalTahapanEdited = 0;
                    $.each($.parseJSON(res), function(i,v) {
                        if(i == 0) $("#totalTahapanEdited").html(v.count);
                        _html += '<tr>';
                            _html += '<td>'+(i + 1)+'</td>';
                            _html += '<td>'+v.Tahap+'</td>';
                            _html += '<td>'+v.DrTgl_toPeriode+'</td>';
                            _html += '<td>'+v.SpTgl_toPeriode+'</td>';
                            _html += '<td>'+v.TimeEntry+'</td>';
                            _html += '<td>';
                                _html += '<button type="button" onclick="editTahapan(\''+v.LedgerNo+'\',\''+v.SpTgl+'\',\''+v.DrTgl+'\',\''+v.Tahap+'\',\''+v.id_SisPeng+'\')" class="btn btn-info"><i class="fa fa-edit"></i></button>';
                            _html += '</td>';
                        _html += '</tr>';
                    });
                    $("#appendTahapanTenderList").html(_html);
                    setLoading();
                    if (openModal) {
                        $("#buttonTahapanTender").html('Simpan');
                        $("#tahapanTender").modal('show');
                        changeSistemPengadaan();
                    }
                }
            })
        }
    }
    function openPembukaan(JobNo = null) {
        if (JobNo) {
            $("#JobNo_pembukaan").val(JobNo);
            setLoading(true);
            $.ajax({
                url: '<?= site_url("Ajax/getPembukaanByJobNo/") ?>'+JobNo,
                type: 'GET',
                success:function(res) {
                    var data = $.parseJSON(res);
                    if (data.HasilPembukaan) {
                        var _html = '<img src="<?= base_url("assets/files/jobs/") ?>'+data.HasilPembukaan+'" class="img-thumbnail">';
                        $("#url-pembukaan").html(_html);
                        $("#form-pembukaan").hide();
                        $("#footer-pembukaan").hide();
                        $("#labelUploadFile").hide();
                    } else {
                        $("#form-pembukaan").show();
                        $("#footer-pembukaan").show();
                        $("#url-pembukaan").html('');
                        $("#labelUploadFile").show();
                    }
                    setLoading();
                }
            })
            $("#pembukaan").modal('show');
        }
    }
    function openMPP(JobNo = null, InfoPasarId = null, openModal = true) {
        if (JobNo && InfoPasarId) {
            $("#JobNo_mpp").val(JobNo);
            $("#InfoPasarId_mpp").val(InfoPasarId);
            setLoading(true)
            $.ajax({
                url: '<?= site_url("Ajax/getMPPbyJobNo/") ?>'+JobNo,
                type: 'GET',
                success:function(res) {
                    var _html = '';
                    $.each($.parseJSON(res),function(i,v) {
                        _html += '<tr>';
                            _html += '<td>'+(i + 1)+'</td>';
                            _html += '<td>'+v.Nama+'</td>';
                            _html += '<td>'+v.Posisi+'</td>';
                            _html += '<td>'+v.TakeHomePay+'</td>';
                            _html += '<td>'+v.TimeEntry+'</td>';
                        _html += '</tr>';
                    })
                    $("#appendMPPlist").html(_html);
                    setLoading();
                    if (openModal) {
                        $("#mpp").modal('show');
                    }
                }
            });
        }
    }
    function changeSistemPengadaan(def = null) {
        var id_SisPeng = $("#sistemPengadaan").val();
        $("#labelTahapanTender").html('Loading..');
        $("#NamaSistem").val($("#sistemPengadaan option:selected").text());
        $.ajax({
            url: '<?= site_url("Ajax/getTahapanTenderBySispeng/") ?>'+id_SisPeng,
            type: 'GET',
            success:function(res) {
                var _html = '';
                $.each($.parseJSON(res), function(i,v) {
                    _html += '<option '+(v.NamaTahapan == def ? 'selected': '')+' value="'+v.id_tahapan+'">'+v.NamaTahapan+'</option>';
                })
                $("#Tahap").html(_html);
                $("#labelTahapanTender").html('Nama Tahapan Tender');
            }
        })
    }
    function saveTahapan(ev) {
        var data = $("#formEntryTahapanTender").serializeArray();
        // $(ev).attr('disabled',true).html('Loading..');
        $.ajax({
            url: '<?= site_url("Ajax/addTahapanTender") ?>',
            type: 'POST',
            data: data,
            success:function(res) {
                if (res == 'success') {
                    $("#SpTgl").val('');
                    $("#DrTgl").val('');
                    // openTahapan($("#JobNo_tahapanTender").val(), false);
                    // $("#alertTahapahTender strong").html('Data tahapan tender berhasil disimpan!');
                    // $("#alertTahapahTender").show();
                    // setTimeout(function() {
                    //     $("#alertTahapahTender").hide();
                    // }, 3000);
                }
                $("#tahapan-tender").modal('hide');

                // $(ev).attr('disabled',false).html('Save changes');
            }
        })
    }
    function saveMPP(ev) {
        var data = $("#formMPP").serializeArray();
        // $(ev).attr('disabled',true).html('Loading..');
        $.ajax({
            url: '<?= site_url("Ajax/addMPP") ?>',
            type: 'POST',
            data: data,
            success:function(res) {
                if (res == 'success') {
                    $("#TakeHomePay").val('');
                    // openMPP($("#JobNo_mpp").val(), $("#InfoPasarId_mpp").val(), false);
                }
                $("#power-planning").modal('hide');
                // $(ev).attr('disabled',false).html('Simpan');
            }
        })
    }

    // EDIT TAHAPAN TENDER
    function editTahapan(LedgerNo, SpTgl, DrTgl, Tahap, id_SisPeng) {
        $("#tahapanTender").modal('show');
        $("#LedgerNo").val(LedgerNo);
        $("#DrTgl").val(DrTgl);
        $("#SpTgl").val(SpTgl);
        $("#sistemPengadaan").val(id_SisPeng).change();
        changeSistemPengadaan(Tahap);
        $("#buttonTahapanTender").html('Ubah');
    }
</script>