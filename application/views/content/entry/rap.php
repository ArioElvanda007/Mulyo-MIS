<style type="text/css">
    table tbody tr td button {
        margin-left: 5px;
    }
</style>
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Entry RAP</h1>
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
						<form action="<?= site_url('Entry/rap') ?>" method="POST">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Job No.</label>
                                        <select class="form-control select2" name="JobNo">
                                            <?php foreach ($job as $row => $value): ?>
                                                <option value="<?= $value->JobNo ?>"><?= $value->JobNo ?> - <?= $value->JobNm ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Alokasi</label>
                                        <select class="form-control" name="Alokasi">
                                            <?php foreach ($alokasi as $row => $value): ?>
                                                <option value="<?= $value->Alokasi ?>"><?= $value->Alokasi ?> - <?= $value->Keterangan ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Versi</label>
                                        <input type="number" class="form-control" name="versi" value="0">
                                    </div>
                                </div>
                            </div><!-- / ROW -->
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>