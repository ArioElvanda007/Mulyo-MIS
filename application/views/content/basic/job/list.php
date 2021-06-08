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
						<table id="datatable_serverside" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Job No</th>
									<th>Job Name</th>
									<th>Deskripsi</th>
									<th>Kontraktor</th>
									<th>Status</th>
                                    <th>Kategori</th>
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
                "url": "<?= site_url('Basic/listJob') ?>",
                "type": "POST",
            },
            "columns": [{
                    "data": "JobNo"
                },
                {
                    "data": "JobNm"
                },
                {
                    "data": "Deskripsi"
                },
                {
                    "data": "Kontraktor"
                },
                {
                    "data": "StatusJob"
                },
                {
                    "data": "Kategori"
                },
                {
                    "data": "actions"
                }
            ],
            "columnDefs": [{
                "targets": [6],
                "orderable": false
            }, {
            	width: '5%', targets: 6
            }]
        });
    }
</script>