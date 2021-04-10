<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<h4>Data Sub Instansi Pada Instansi <?= $instansi->NamaDirektorat ?></h4>
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
						<a href="<?= site_url('Basic/instansi') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
						<a href="#add" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						<br /><br />
						<table id="datatable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No. Urut</th>
									<th>Nama Sub Ditjen (BWS/BBWS)</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $row => $value): ?>
									<tr>
										<td style="width: 5%"><?= $row + 1 ?></td>
										<td><?= $value->NamaSubInstansi ?></td>
										<td style="width: 15%">
											<a href="#edit<?= $row ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= site_url('Basic/sub_instansi/'.$instansi->Id_Instansi.'/'.$value->Id_SubInstansi) ?>" onclick="return confirm('Apa anda yakin?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
									<!-- MODAL EDIT -->
									<div class="modal fade" id="edit<?= $row ?>">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title"><i class="fa fa-edit"></i> Ubah Data</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														<span class="sr-only">Close</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?= site_url('Basic/sub_instansi') ?>" method="POST">
														<input type="hidden" name="Id_SubInstansi" value="<?= $value->Id_SubInstansi ?>">
														<div class="form-group">
															<label>Nama Sub Ditjen (BWS/BBWS)*</label>
															<input type="text" class="form-control" name="NamaSubInstansi" required value="<?= $value->NamaSubInstansi ?>">
														</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
													<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
												</div>
												</form>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- MODAL ADD -->
<div class="modal fade" id="add">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('Basic/sub_instansi') ?>" method="POST">
					<input type="hidden" name="Id_Ditjen" value="<?= $instansi->Id_Instansi ?>">
					<input type="hidden" name="NamaDirektorat" value="<?= $instansi->NamaDirektorat ?>">
					<div class="form-group">
						<label>Nama Sub Ditjen (BWS/BBWS)*</label>
						<input type="text" class="form-control" name="NamaSubInstansi" required>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" onclick="return confirm('Apa anda yakin?')" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>