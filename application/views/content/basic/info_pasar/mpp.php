<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<h1>Data Man Power Planning Pada Info Pasar: <?= $info_pasar->NamaPaket ?></h1>
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
						<a href="<?= site_url("Basic/info_pasar") ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembal</a>
						<a href="#add" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						<br /><br />
						<table id="datatable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Nama Karyawan</th>
									<th>Posisi</th>
									<th>Take Home Pay (Rp)</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $row => $value): ?>
									<tr>
										<td><?= $value->NIK.' - '.$value->Nama ?></td>
										<td><?= $value->Posisi ?></td>
										<td><?= number_format($value->TakeHomePay) ?></td>
										<td style="width: 15%">
											<a href="#edit<?= $row ?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= site_url('Basic/info_pasar_mpp/'.$value->InfoPasarId.'/'.$value->LedgerNo) ?>" onclick="return confirm('Apa anda yakin?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
									<!-- EDIT -->
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
													<form action="<?= site_url('Basic/info_pasar_mpp') ?>" method="POST">
														<input type="hidden" name="LedgerNo" value="<?= $value->LedgerNo ?>">
														<div class="form-group">
															<label>Karyawan*</label>
															<select class="form-control select2" name="karyawan">
																<?php foreach ($karyawan as $r => $v): ?>
																	<option <?= ($v->NIK == $value->NIK ? 'selected' : '') ?> value="<?= $v->NIK.'-'.$v->Nama ?>"><?= $v->NIK.' - '.$v->Nama ?></option>
																<?php endforeach ?>
															</select>
														</div>
														<div class="form-group">
															<label>Posisi*</label>
															<select class="form-control select2" name="Posisi">
																<?php foreach ($posisi as $r => $v): ?>
																	<option <?= ($value->Posisi == $v ? 'selected' : '') ?> value="<?= $v ?>"><?= $v ?></option>
																<?php endforeach ?>
															</select>
														</div>
														<div class="form-group">
															<?php
																$TakeHomePay = 0;
																$arr = explode('.', $value->TakeHomePay);
																if (isset($arr[0])) {
																	$TakeHomePay = $arr[0];
																}
															?>
															<label>Take Home Pay*</label>
															<input type="text" onkeyup="toDecimal(this)" class="form-control" required name="TakeHomePay" value="<?= number_format($TakeHomePay) ?>">
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

<!-- MODAL -->
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
				<form action="<?= site_url('Basic/info_pasar_mpp') ?>" method="POST">
					<input type="hidden" name="InfoPasarId" value="<?= $info_pasar->InfoPasarId ?>">
					<input type="hidden" name="JobNo" value="<?= $info_pasar->jobNo ?>">
					<div class="form-group">
						<label>Karyawan*</label>
						<select class="form-control select2" name="karyawan">
							<?php foreach ($karyawan as $r => $v): ?>
								<option value="<?= $v->NIK.'-'.$v->Nama ?>"><?= $v->NIK.' - '.$v->Nama ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Posisi*</label>
						<select class="form-control select2" name="Posisi">
							<?php foreach ($posisi as $r => $v): ?>
								<option value="<?= $v ?>"><?= $v ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Take Home Pay*</label>
						<input type="text" onkeyup="toDecimal(this)" class="form-control" required name="TakeHomePay" value="0">
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