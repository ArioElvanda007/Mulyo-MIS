<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Tambah Proposal</h1>
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
						<a href="<?= site_url('Basic/proposal') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
						<a href="#save" data-toggle="modal" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</a>
						<br /><br />
						<form action="<?= site_url('Basic/proposal_add') ?>" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="JobNo" id="JobNo">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label>Job No.</label>
										<select class="form-control" name="InfoPasarId" id="InfoPasarId" onchange="changeJobNo()">
											<?php foreach ($infoPasar as $row => $value): ?>
												<?php if ($value->jobNo != '0'): ?>
													<option value="<?= $value->InfoPasarId ?>"><?= $value->jobNo ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Info Pasar</label>
										<input type="text" name="JobNm" id="InfoPasar" class="form-control">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Nama Proyek</label>
										<input type="text" name="NamaProyek" id="NamaProyek" class="form-control">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Lingkup Pekerjaan</label>
										<textarea class="form-control" name="LingkupPekerjaan" rows="5"></textarea>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Lokasi*</label>
										<input type="text" class="form-control" name="Lokasi" required>
									</div>
									<div class="form-group">
										<label>Instansi/Balai*</label>
										<input type="text" class="form-control" name="Instansi" id="Instansi" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Provinsi*</label>
										<select class="form-control" name="Provinsi">
											<?php foreach ($provinces as $row => $value): ?>
												<option value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label>Peserta Tender*</label>
										<select class="form-control" name="PesertaTender" id="PesertaTender" onchange="changePesertaTender()">
											<option value="Tunggal">Tunggal</option>
											<option value="KSO">KSO</option>
										</select>
									</div>
								</div>
							</div><!-- / ROW -->
							<legend>Peserta Tender</legend>
							<div class="row">
								<div class="col-sm-6">
									<input type="hidden" name="totalTender" id="totalTender" value="0">
									<button type="button" id="btnCloneTender" class="btn btn-info" style="float: right;margin-left: 10px;" onclick="cloneTender()"><i class="fa fa-plus"></i> Tender</button>
									<button type="button" id="btnRemoveTender" class="btn btn-danger" style="float: right;display: none;" onclick="removeTender()"><i class="fa fa-times"></i> Hapus</button>
									<br /><br />
									<div id="appendTender"></div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Satuan Kerja</label>
										<input type="text" class="form-control" name="SatuanKerja" id="SatuanKerja">
									</div>
									<div class="form-group">
										<label>Sumber Dana</label>
										<input type="text" class="form-control" name="SumberDana" id="SumberDana">
									</div>
									<div class="form-group">
										<label>Tipe Pekerjaan</label>
										<input type="text" class="form-control" name="TipePekerjaan" id="TipePekerjaan">
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Tahun Anggaran</label>
												<input type="number" class="form-control" name="TahunAnggaran" id="TahunAnggaran" value="<?= date('Y') ?>">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Peluang (%)</label>
												<select class="form-control" name="Peluang">
													<?php foreach (range(1,100) as $row => $value): ?>
														<option <?= ($value == 75 ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div><!-- / ROW -->
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>HPS (Rp)</label>
												<input type="text" class="form-control" name="HPS" id="HPS" onkeyup="toDecimal(this)" value="0">
											</div>	
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Rencana Tender</label>
												<input type="date" class="form-control" name="RencanaTender">
											</div>
										</div>
									</div><!-- / ROW -->
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>SYC/MYC</label>
												<select class="form-control" name="SistemKontrak" id="SistemKontrak">
													<option value="SYC">SYC</option>
													<option value="MYC">MYC</option>
												</select>
											</div>	
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Upload File PDF RAP</label>
												<input type="file" class="form-control" name="RAPfile">
											</div>
										</div>
									</div><!-- / ROW -->
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
	$(function() {
		changeJobNo();
		cloneTender();
	})
	function changeJobNo() {
		var InfoPasarId = $("#InfoPasarId").val();
		setLoading(true);
		$.ajax({
			url:'<?= site_url("Ajax/getInfoPasarById/") ?>'+InfoPasarId,
			type:'GET',
			success:function(res) {
				if (res) {
					var data = $.parseJSON(res);
					$("#JobNo").val(data.jobNo);
					$("#InfoPasar").val(data.NamaPaket);
					$("#NamaProyek").val(data.NamaPaket);
					$("#Instansi").val(data.NamaBalai);
					$("#SatuanKerja").val(data.SatuanKerja);
					$("#TipePekerjaan").val(data.TipePekerjaan);
					$("#Instansi").val(data.NamaBalai);
					$("#HPS").val(numeral(data.HPS).format('0,0'));
					$("#SistemKontrak").val(data.SistemKontrak);
					$("#TahunAnggaran").val(data.TahunAnggaran);
				}
				setLoading();
			}
		})
	}
	function changePesertaTender() {
		$("#appendTender").empty();
		$("#totalTender").val(0);
		cloneTender();
	}
	function cloneTender() {
		var totalTender = parseInt($("#totalTender").val());
		++totalTender;
		var _html = '';
		_html += '<div id="tender-group'+totalTender+'">';
			_html += '<input type="hidden" name="totalMember'+totalTender+'" id="totalMember'+totalTender+'" value="0">';
			_html += '<div class="row">';
				_html += '<div class="col-sm-8 offset-2">';
					_html += '<label>Logo</label>';
					_html += '<div class="imagePreview">';
						_html += '<input type="file" name="tenderLogo'+totalTender+'" class="upload" onchange="preview(this)">';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Penawaran Bruto (Rp)</label>';
						_html += '<input type="text" class="form-control" name="PenawaranBruto'+totalTender+'" onkeyup="toDecimal(this)" value="0">';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Penawaran Exclude PPN</label>';
						_html += '<input type="text" class="form-control" name="PenawaranNetto'+totalTender+'" onkeyup="toDecimal(this)" value="0">';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Leader '+totalTender+'</label>';
						_html += '<select class="form-control" name="leader'+totalTender+'" id="leader'+totalTender+'">';
							$.each($.parseJSON('<?= $pesertaTender ?>'), function(i,v) {
								_html += '<option value="'+v+'">'+v+'</option>';
							})
						_html += '</select>';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Porsi (%)</label>';
						_html += '<input type="number" class="form-control" name="leaderPorsi'+totalTender+'" id="leaderPorsi'+totalTender+'" value="0">';
					_html += '</div>';
				_html += '</div>';
			_html += '</div>';
			if ($("#PesertaTender").val() == 'KSO') {
				_html += '<div id="appendTenderMember'+totalTender+'"></div>';
				_html += '<button type="button" id="btnCloneMember'+totalTender+'" class="btn btn-primary" onclick="cloneMember(\''+totalTender+'\')"><i class="fa fa-plus"></i> Member</button>';
				_html += '<button type="button" id="btnRemoveMember'+totalTender+'" class="btn btn-danger" style="margin-left:10px;display:none" onclick="removeMember(\''+totalTender+'\')"><i class="fa fa-trash"></i> Member</button>';
			}
			_html += '<hr />';
		_html += '</div>';
		$("#appendTender").append(_html);
		$("#totalTender").val(totalTender);
		if ($("#PesertaTender").val() == 'KSO') {
			cloneMember(totalTender);
		}
		if (totalTender > 1) { 
			$("#btnRemoveTender").show();
		} else {
			$("#btnRemoveTender").hide();
		}
		if (totalTender >= 5) {
			$("#btnCloneTender").hide();
		}
	}
	function removeTender() {
		var totalTender = parseInt($("#totalTender").val());
		$("#tender-group"+totalTender).remove();
		--totalTender;
		$("#totalTender").val(totalTender);
		if (totalTender <= 1) { 
			$("#btnRemoveTender").hide();
		} else {
			$("#btnCloneTender").show();
		}
	}
	function cloneMember(tenderIndex = null) {
		var totalMember = parseInt($("#totalMember"+tenderIndex).val());
		++totalMember;
		var _html = '';
		_html += '<div class="row" id="member-group'+tenderIndex+'-'+totalMember+'">';
			_html += '<div class="col-sm-6">';
				_html += '<div class="form-group">';
					_html += '<label>Member '+totalMember+'</label>';
					_html += '<select class="form-control" name="member-'+tenderIndex+'-'+totalMember+'" id="member-'+tenderIndex+'-'+totalMember+'">';
						$.each($.parseJSON('<?= $pesertaTender ?>'), function(i,v) {
							_html += '<option value="'+v+'">'+v+'</option>';
						});
					_html += '</select>';
				_html += '</div>';
			_html += '</div>';
			_html += '<div class="col-sm-6">';
				_html += '<div class="form-group">';
					_html += '<label>Porsi (%)</label>';
					_html += '<input type="number" class="form-control" name="memberPorsi-'+tenderIndex+'-'+totalMember+'" id="memberPorsi-'+tenderIndex+'-'+totalMember+'" value="0">';
				_html += '</div>';
			_html += '</div>';
		_html += '</div>';
		$("#appendTenderMember"+tenderIndex).append(_html);
		$("#totalMember"+tenderIndex).val(totalMember);
		if (totalMember > 1) { 
			$("#btnRemoveMember"+tenderIndex).show();
		} else {
			$("#btnRemoveMember"+tenderIndex).hide();
		}
		if (totalMember >= 5) { 
			$("#btnCloneMember"+tenderIndex).hide();
		}
	}
	function removeMember(tenderIndex = null) {
		if (tenderIndex) {
			var totalMember = parseInt($("#totalMember"+tenderIndex).val());
			$("#member-group"+tenderIndex+'-'+totalMember).remove();
			--totalMember;
			$("#totalMember"+tenderIndex).val(totalMember);
			if (totalMember <= 1) { 
				$("#btnRemoveMember"+tenderIndex).hide();
			} else {
				$("#btnCloneMember"+tenderIndex).show();
			}
		}
	}
</script>