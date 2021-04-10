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
						<a href="#add" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						<br /><br />
						<table id="datatable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No. Urut</th>
									<th>Nama Instansi/Direktorat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $row => $value): ?>
									<tr>
										<td style="width: 5%"><?= $row + 1 ?></td>
										<td><?= $value->NamaDirektorat ?></td>
										<td style="width: 15%">
											<a title="Tambah Detail" href="<?= site_url("Basic/sub_instansi/".$value->Id_Instansi) ?>" class="btn btn-success"><i class="fa fa-cubes"></i></a>
											<a href="#edit<?= $row ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= site_url('Basic/instansi/'.$value->Id_Instansi) ?>" onclick="return confirm('Apa anda yakin?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
													<form action="<?= site_url('Basic/instansi') ?>" method="POST">
														<input type="hidden" name="Id_Instansi" value="<?= $value->Id_Instansi ?>">
														<div class="form-group">
															<label>Nama Instansi/Direktorat*</label>
															<input type="text" class="form-control" name="NamaDirektorat" required value="<?= $value->NamaDirektorat ?>">
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
				<form action="<?= site_url('Basic/instansi') ?>" method="POST">
					<div class="form-group">
						<label>Nama Instansi/Direktorat*</label>
						<input type="text" class="form-control" name="NamaDirektorat" required>
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