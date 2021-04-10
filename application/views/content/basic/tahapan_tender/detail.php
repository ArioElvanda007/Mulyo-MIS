<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<h4>Tahapan Tender Pada: <?= $master->NamaSistem ?></h4>
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
						<a href="<?= site_url('Basic/tahapan_tender') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
						<a href="#add" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						<br /><br />
						<table id="datatable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No. Urut</th>
									<th>Nama Tahapan Pengadaan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $row => $value): ?>
									<tr>
										<td style="width: 5%"><?= $row + 1 ?></td>
										<td><?= $value->NamaTahapan ?></td>
										<td style="width: 15%">
											<a href="#edit<?= $row ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= site_url('Basic/tahapan_detail/'.$master->id_SisPeng.'/'.$value->id_tahapan) ?>" onclick="return confirm('Apa anda yakin?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
													<form action="<?= site_url('Basic/tahapan_detail') ?>" method="POST">
														<input type="hidden" name="id_tahapan" value="<?= $value->id_tahapan ?>">
														<div class="form-group">
															<label>Nama Tahapan Pengadaan*</label>
															<input type="text" class="form-control" name="NamaTahapan" required value="<?= $value->NamaTahapan ?>">
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
				<form action="<?= site_url('Basic/tahapan_detail') ?>" method="POST">
					<input type="hidden" name="id_SisPeng" value="<?= $master->id_SisPeng ?>">
					<input type="hidden" name="NamaSistem" value="<?= $master->NamaSistem ?>">
					<div class="form-group">
						<label>Nama Tahapan Pengadaan*</label>
						<input type="text" class="form-control" name="NamaTahapan" required>
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