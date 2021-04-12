<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Data Instansi</h1>
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
                <form action="<?= site_url('Basic/addTahapanTender') ?>" method="POST">
                    <input type="hidden" name="JobNo" id="JobNo_tahapanTender" value="0">
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
                                <input type="date" class="form-control" name="DrTgl">
                            </div>
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="SpTgl">
                            </div>
                        </div>
                    </div><!-- / ROW -->
                    <button class="btn btn-primary" type="submit" onclick="return confirm('Apa anda yakin?')">Simpan</button>
                </form>
                <br />
                <legend>List Tahapan Tender</legend>
                <br />
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">No. Urut</th>
                            <th>Nama Tahapan Tender</th>
                            <th>Dari Tanggal</th>
                            <th>Sampai Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="appendTahapanTenderList"></tbody>
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
                    "data": "actions"
                }
            ],
            "columnDefs": [{
                "targets": [6],
                "orderable": false
            }, {
            	width: '22%', targets: 6
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
    function openTahapan(JobNo = null) {
        if (JobNo) {
            $("#JobNo_tahapanTender").val(JobNo);
            setLoading(true);
            $.ajax({
                url: '<?= site_url("Ajax/getTahapanTenderByJobNo/") ?>'+JobNo,
                type: 'GET',
                success:function(res) {
                    var _html = '';
                    $.each($.parseJSON(res), function(i,v) {
                        _html += '<tr>';
                            _html += '<td>'+(i + 1)+'</td>';
                            _html += '<td>'+v.Tahap+'</td>';
                            _html += '<td>'+v.DrTgl+'</td>';
                            _html += '<td>'+v.SpTgl+'</td>';
                        _html += '</tr>';
                    });
                    $("#appendTahapanTenderList").html(_html);
                    setLoading();
                    $("#tahapanTender").modal('show');
                    changeSistemPengadaan();
                }
            })
        }
    }
    function changeSistemPengadaan() {
        var id_SisPeng = $("#sistemPengadaan").val();
        $("#labelTahapanTender").html('Loading..');
        $.ajax({
            url: '<?= site_url("Ajax/getTahapanTenderBySispeng/") ?>'+id_SisPeng,
            type: 'GET',
            success:function(res) {
                var _html = '';
                $.each($.parseJSON(res), function(i,v) {
                    _html += '<option value="'+v.NamaTahapan+'">'+v.NamaTahapan+'</option>';
                })
                $("#Tahap").html(_html);
                $("#labelTahapanTender").html('Nama Tahapan Tender');
            }
        })
    }
</script>