<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Data Info Pasar</h1>
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
						<a href="<?= site_url('Basic/info_pasar_add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
						<br /><br />
						<table id="datatable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Job No.</th>
									<th>Triwulan</th>
									<th>Periode</th>
									<th>Tipe Pekerjaan</th>
									<th>Nama Paket</th>
									<th>Hps (Rp)</th>
									<th>Pemberi Kerja</th>
									<th>SYC/MYC</th>
									<th>Sumber Dana</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $row => $value): ?>
									<tr>
										<td><?= $value->jobNo ?></td>
										<td><?= $value->triwulan ?></td>
										<td><?= $value->periode ?></td>
										<td><?= $value->TipePekerjaan ?></td>
										<td><?= $value->NamaPaket ?></td>
										<td><?= number_format($value->HPS) ?></td>
										<td><?= $value->PemberiKerja ?></td>
										<td><?= $value->SistemKontrak ?></td>
										<td><?= $value->SumberDana ?></td>
										<td><?= $value->Status ?></td>
										<td style="width: 15%">
											<a href="<?= site_url('Basic/info_pasar_mpp/'.$value->InfoPasarId) ?>" class="btn btn-success"><i class="fa fa-users"></i></a>
											<a href="<?= site_url('Basic/info_pasar_edit/'.$value->InfoPasarId) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= site_url('Basic/info_pasar/'.$value->InfoPasarId) ?>" onclick="return confirm('Apa anda yakin?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>