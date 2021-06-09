<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Data Users</h1>
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
									<th>#</th>
									<th>User ID</th>
									<th>Nama</th>
									<th>NIK</th>
									<th>Email</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $row => $value): ?>
									<tr>
										<td style="width: 5%"><?= $row + 1 ?></td>
										<td><?= $value->UserID ?></td>
										<td><?= $value->UserName ?></td>
										<td><?= $value->NIK ?></td>
										<td><?= $value->Email ?></td>
										<td style="width: 15%">
											<a href="#edit<?= $row ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= site_url('Basic/users/'.$value->UserID) ?>" onclick="return confirm('Apa anda yakin?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
													<form action="<?= site_url('Basic/users') ?>" method="POST">
														<input type="hidden" name="update" value="true">
														<input type="hidden" class="form-control" name="UserID" required value="<?= $value->UserID ?>">
														<div class="form-group">
															<label>Nama*</label>
															<input type="text" required class="form-control" name="UserName" value="<?= $value->UserName ?>">
														</div>
														<div class="form-group">
															<label>Password</label>
															<input type="password" class="form-control" name="Password">
														</div>
														<div class="form-group">
															<label>NIK</label>
															<input type="text" class="form-control" name="NIK" value="<?= $value->NIK ?>">
														</div>
														<div class="form-group">
															<label>Email</label>
															<input type="email" class="form-control" name="Email" value="<?= $value->Email ?>">
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
				<form action="<?= site_url('Basic/users') ?>" method="POST">
					<div class="form-group">
						<label>User ID*</label>
						<input type="text" class="form-control" name="UserID" required>
					</div>
					<div class="form-group">
						<label>Nama*</label>
						<input type="text" required class="form-control" name="UserName">
					</div>
					<div class="form-group">
						<label>Password*</label>
						<input type="password" required class="form-control" name="Password">
					</div>
					<div class="form-group">
						<label>NIK</label>
						<input type="text" class="form-control" name="NIK">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="Email">
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