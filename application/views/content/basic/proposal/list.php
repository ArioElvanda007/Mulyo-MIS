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
</script>