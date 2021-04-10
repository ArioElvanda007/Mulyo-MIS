<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Ubah Info Pasar</h1>
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
						<a href="<?= site_url('Basic/info_pasar') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
						<a href="#save" data-toggle="modal" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</a>
						<br /><br />
						<form action="<?= site_url('Basic/info_pasar_edit') ?>" method="POST">
							<input type="hidden" name="InfoPasarId" value="<?= $data->InfoPasarId ?>">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Job No.</label>
										<input type="text" class="form-control" readonly placeholder="<?= $data->jobNo ?>">
									</div>
									<div class="form-group">
										<label>Jenis Pekerjaan*</label>
										<select class="form-control" name="TipePekerjaan">
											<?php foreach (['BENDUNG','BENDUNGAN','IRIGASI','IRIGASI','PERPIPAAN','PENGENDALIAN BANJIR','SUNGAI DAN PANTAI'] as $row => $value): ?>
												<option <?= ($value == $data->TipePekerjaan ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label>Nama Paket*</label>
										<input type="text" class="form-control" required name="NamaPaket" value="<?= $data->NamaPaket ?>">
									</div>
									<div class="form-group">
										<label>HPS (Rp)*</label>
										<input type="number" class="form-control" required name="HPS" value="<?= $data->HPS ?>">
									</div>
									<div class="form-group">
										<label>SYC/MYC*</label>
										<select class="form-control" name="SistemKontrak">
											<?php foreach (['SYC','MYC'] as $row => $value): ?>
												<option <?= ($value == $data->SistemKontrak ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label>Rencana Tayang*</label>
										<input type="date" class="form-control" required name="PeriodeTriwulan" value="<?= $data->PeriodeTriwulan ?>">
									</div>
									<div class="form-group">
										<label>Status Info*</label>
										<select class="form-control" name="Status">
											<?php foreach (['Partisipasi','Tidak Partisipasi'] as $row => $value): ?>
												<option <?= ($value == $data->Status ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Pemberi Kerja/Owner*</label>
										<select class="form-control" name="PemberiKerja" id="PemberiKerja" onchange="changePemberiKerja()">
											<?php foreach (['PEMERINTAH','SWASTA','BUMN','PROPINSI'] as $row => $value): ?>
												<option <?= ($value == $data->PemberiKerja ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<legend style="margin-top: 40px">Owner</legend>
									<div id="box-pemerintah" style="margin-top: 22px">
										<div class="form-group">
											<label>Instansi</label>
											<select class="form-control" name="NamaInstansi" id="NamaInstansi" onchange="changeInstansi()">
												<?php foreach ($instansi as $row => $value): ?>
													<option <?= ($value->NamaDirektorat == $data->NamaInstansi ? 'selected' : '') ?> value="<?= $value->Id_Instansi ?>"><?= $value->NamaDirektorat ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label id="labelSubInstansi">Sub Instansi</label>
											<select class="form-control" name="NamaBalai" id="NamaSubInstansi"></select>
										</div>
										<div class="form-group">
											<label>Satuan Kerja</label>
											<select class="form-control" name="SatuanKerja">
												<?php foreach (['PJPA','PJSA','OPERASI & PEMELIHARAAN'] as $row => $value): ?>
													<option <?= ($value == $data->SatuanKerja ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label>Sumber Dana</label>
											<select class="form-control" name="SumberDana">
												<?php foreach (['Dalam Negeri','Luar Negeri'] as $row => $value): ?>
													<option <?= ($value == $data->SumberDana ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label>Sumber Dana Dalam Negeri</label>
											<select class="form-control" name="SumberDanaDalamNegeri">
												<?php foreach (['Swasta','Pemerintah'] as $row => $value): ?>
													<option <?= ($value == $data->SumberDanaDalamNegeri ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group">
											<label>Sumber Dana Negara</label>
											<select class="form-control" name="SDDN">
												<?php foreach (['APBN','SBSN','LOAD'] as $row => $value): ?>
													<option <?= ($value == $data->SDDN ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div id="box-swasta" style="margin-top:25px; display: none;">
										<div class="form-group">
											<label>Nama</label>
											<input type="text" class="form-control" name="Owners" value="<?= $data->Owners ?>">
										</div>
									</div>
								</div>
							</div><!-- / ROW -->
							<!-- MODAL SAVE -->
							<div class="modal fade" id="save">
								<div class="modal-dialog" role="document">
									<div class="modal-content modal-sm">
										<div class="modal-header">
											<h4 class="modal-title"><i class="fa fa-question-circle"></i> Apa anda yakin?</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												<span class="sr-only">Close</span>
											</button>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	changePemberiKerja();
	function changePemberiKerja() {
		if ($("#PemberiKerja").val() != 'PEMERINTAH') {
			$("#box-pemerintah").hide();
			$("#box-swasta").show();
		} else {
			$("#box-swasta").hide();
			$("#box-pemerintah").show();
		}
	}
	changeInstansi();
	function changeInstansi() {
		var ID = $("#NamaInstansi").val();
		$("#labelSubInstansi").html('Loading..')
		$.ajax({
			url: '<?= site_url("Ajax/getSubByInstansi/") ?>'+ID,
			type: 'GET',
			success:function(res) {
				var _option = '';
				var subInstansi = '<?= $data->NamaBalai ?>';
				console.log(subInstansi);
				$.each(JSON.parse(res), function(i, v) {
					var selected = '';
					if(v.NamaSubInstansi == subInstansi) {
						selected = 'selected';
					}
					_option += '<option '+selected+' value="'+v.Id_SubInstansi+'">'+v.NamaSubInstansi+'</option>';
				})
				$("#labelSubInstansi").html('Sub Instansi');
				$("#NamaSubInstansi").html(_option);
			}
		})
	}
</script>