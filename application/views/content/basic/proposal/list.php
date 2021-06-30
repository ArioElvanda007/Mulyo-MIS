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
						<table id="datatable_serverside" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Job No</th>
									<th>Nama Proyek</th>
									<th>Provinsi</th>
									<th>Instansi</th>
									<th>HPS (Rp)</th>
									<th>Status</th>
                                    <th>Tahapan Tender</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MODALS -->
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
                <div class="alert alert-success" id="alertTahapahTender" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Heheey</strong>
                </div>
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
                            <th>Aksi</th>
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
                    _html += '<option '+(v.NamaTahapan == def ? 'selected': '')+' value="'+v.NamaTahapan+'">'+v.NamaTahapan+'</option>';
                })
                $("#Tahap").html(_html);
                $("#labelTahapanTender").html('Nama Tahapan Tender');
            }
        })
    }
    function saveTahapan(ev) {
        var data = $("#formEntryTahapanTender").serializeArray();
        $(ev).attr('disabled',true).html('Loading..');
        $.ajax({
            url: '<?= site_url("Ajax/addTahapanTender") ?>',
            type: 'POST',
            data: data,
            success:function(res) {
                if (res == 'success') {
                    $("#SpTgl").val('');
                    $("#DrTgl").val('');
                    openTahapan($("#JobNo_tahapanTender").val(), false);
                    $("#alertTahapahTender strong").html('Data tahapan tender berhasil disimpan!');
                    $("#alertTahapahTender").show();
                    setTimeout(function() {
                        $("#alertTahapahTender").hide();
                    }, 3000);
                }
                $(ev).attr('disabled',false).html('Simpan');
            }
        })
    }
    function saveMPP(ev) {
        var data = $("#formMPP").serializeArray();
        $(ev).attr('disabled',true).html('Loading..');
        $.ajax({
            url: '<?= site_url("Ajax/addMPP") ?>',
            type: 'POST',
            data: data,
            success:function(res) {
                if (res == 'success') {
                    $("#TakeHomePay").val('');
                    openMPP($("#JobNo_mpp").val(), $("#InfoPasarId_mpp").val(), false);
                }
                $(ev).attr('disabled',false).html('Simpan');
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