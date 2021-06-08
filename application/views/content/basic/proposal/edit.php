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
						<form action="<?= site_url('Basic/proposal_edit') ?>" method="POST" enctype="multipart/form-data">
							<input type="hidden" id="InfoPasarId" name="InfoPasarId" value="<?= $data->InfoPasarId ?>">
							<input type="hidden" id="SDDN" value="">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label>Job No.</label>
										<input type="text" class="form-control" name="JobNo" id="JobNo" readonly value="<?= $data->JobNo ?>">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Info Pasar</label>
										<input type="text" name="JobNm" id="InfoPasar" class="form-control" value="<?= $data->JobNm ?>">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Nama Proyek</label>
										<input type="text" name="NamaProyek" id="NamaProyek" class="form-control" value="<?= $data->JobNm ?>">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Lingkup Pekerjaan</label>
										<textarea class="form-control" name="LingkupPekerjaan" rows="5"><?= $data->Deskripsi ?></textarea>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Lokasi*</label>
										<input type="text" class="form-control" name="Lokasi" required value="<?= $data->Lokasi ?>">
									</div>
									<div class="form-group">
										<label>Instansi/Balai*</label>
										<input type="text" class="form-control" name="Instansi" id="Instansi" required value="<?= $data->Instansi ?>">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Provinsi*</label>
										<select class="form-control" name="Provinsi">
											<?php foreach ($provinces as $row => $value): ?>
												<option <?= ($value == $data->Provinsi ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label>Peserta Tender*</label>
										<select class="form-control" name="PesertaTender" id="PesertaTender" onchange="changePesertaTender()">
											<option value="Tunggal">Tunggal</option>
											<option <?= ($data->KSO == 1 ? 'selected' : '') ?> value="KSO">KSO</option>
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
										<select class="form-control" name="SumberDana">
											<option value="APBN">APBN</option>
											<option <?= ($data->SumberDana == 'SBSN' ? 'selected' : '') ?> value="SBSN">SBSN</option>
										</select>
									</div>
									<div class="form-group">
										<label>Tipe Pekerjaan</label>
										<input type="text" class="form-control" name="TipePekerjaan" id="TipePekerjaan" value="<?= $data->TipePekerjaan ?>">
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Tahun Anggaran</label>
												<input type="number" class="form-control" name="TahunAnggaran" id="TahunAnggaran" value="<?= $data->TahunAnggaran ?>">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Peluang (%)</label>
												<select class="form-control" name="Peluang">
													<?php foreach (range(1,100) as $row => $value): ?>
														<option <?= ($value == $data->Peluang ? 'selected' : '') ?> value="<?= $value ?>"><?= $value ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div><!-- / ROW -->
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>HPS (Rp)</label>
												<input type="text" class="form-control" name="HPS" id="HPS" onkeyup="toDecimal(this)" value="<?= number_format($data->HPS) ?>">
											</div>	
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Rencana Tender</label>
												<input type="date" class="form-control" name="RencanaTender" value="<?= $data->TglKontrak ?>">
											</div>
										</div>
									</div><!-- / ROW -->
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>SYC/MYC</label>
												<select class="form-control" name="SistemKontrak" id="SistemKontrak">
													<option value="SYC">SYC</option>
													<option <?= ($data->SistemKontrak == 'MYC' ? 'selected' : '') ?> value="MYC">MYC</option>
												</select>
											</div>	
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Upload File PDF RAP</label>
												<input type="file" class="form-control" name="RAPfile"><br />
												<p>
													File sebelumnya: <a href="<?= base_url('assets/files/jobs/'.$data->RAPFile) ?>" target="_blank">
														Lihat disini <i class="fa fa-paper-plane"></i>
													</a>
												</p>
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
	var dataPeserta = $.parseJSON('<?= json_encode($data->peserta) ?>');
	$(function() {
		changeJobNo();
		for (var i = 0; i < dataPeserta.length; i++) {
			cloneTender(i);
		}
	})
	function changeJobNo() {
		var InfoPasarId = $("#InfoPasarId").val();
		if (InfoPasarId) {
			setLoading(true);
			$.ajax({
				url:'<?= site_url("Ajax/getInfoPasarById/") ?>'+InfoPasarId,
				type:'GET',
				success:function(res) {
					if (res) {
						var data = $.parseJSON(res);
						$("#SatuanKerja").val(data.SatuanKerja);
						$("#SDDN").val(data.SDDN);
					}
					setLoading();
				}
			})
		}
	}
	function changePesertaTender() {
		$("#appendTender").empty();
		$("#totalTender").val(0);
		cloneTender();
	}
	function cloneTender(row = null) {
		var totalTender = parseInt($("#totalTender").val());
		++totalTender;
		var style = (row != null ? 'background:url(<?= base_url("assets/files/jobs/") ?>'+dataPeserta[row].logo+');background-size:cover;background-position:center;background-repeat:no-repeat' : '');
		var defaultBruto = (row != null ? numeral(dataPeserta[row].PenawaranBruto).format('0,0') : '0');
		var defaultNetto = (row != null ? numeral(dataPeserta[row].PenawaranNetto).format('0,0') : '0');
		var leader = (row != null ? dataPeserta[row].Leader : '');
		var porsi = (row != null ? dataPeserta[row].PorsiLeader : '');
		var logo = (row != null ? dataPeserta[row].logo : null);
		var _html = '';
		_html += '<div id="tender-group'+totalTender+'">';
			_html += '<input type="hidden" name="totalMember'+totalTender+'" id="totalMember'+totalTender+'" value="0">';
			_html += '<input type="hidden" name="logo'+totalTender+'" value="'+logo+'">';
			_html += '<div class="row">';
				_html += '<div class="col-sm-8 offset-2">';
					_html += '<label>Logo</label>';
					_html += '<div class="imagePreview" style="'+style+'">';
						_html += '<input type="file" name="tenderLogo'+totalTender+'" class="upload" onchange="preview(this)">';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Penawaran Bruto (Rp)</label>';
						_html += '<input type="text" class="form-control" name="PenawaranBruto'+totalTender+'" onkeyup="bruto(this,\''+totalTender+'\')" value="'+defaultBruto+'">';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Penawaran Exclude PPN</label>';
						_html += '<input type="text" class="form-control" name="PenawaranNetto'+totalTender+'" id="PenawaranNetto'+totalTender+'" onkeyup="toDecimal(this)" value="'+defaultNetto+'">';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Leader '+totalTender+'</label>';
						_html += '<select class="form-control" name="leader'+totalTender+'" id="leader'+totalTender+'">';
							$.each($.parseJSON('<?= $pesertaTender ?>'), function(i,v) {
								var selected = (v == leader ? 'selected' : '');
								_html += '<option '+selected+' value="'+v+'">'+v+'</option>';
							})
						_html += '</select>';
					_html += '</div>';
				_html += '</div>';
				_html += '<div class="col-sm-6">';
					_html += '<div class="form-group">';
						_html += '<label>Porsi (%)</label>';
						_html += '<input type="number" class="form-control" name="leaderPorsi'+totalTender+'" id="leaderPorsi'+totalTender+'" placeholder="0" onkeyup="valPorsi(this,\''+totalTender+'\')" value="'+porsi+'">';
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
			if (dataPeserta[row].Member1 != null && dataPeserta[row].Member1 != '') {
				cloneMember(totalTender, dataPeserta[row], 1);
			}
			if (dataPeserta[row].Member2 != null && dataPeserta[row].Member2 != '') {
				cloneMember(totalTender, dataPeserta[row], 2);
			}
			if (dataPeserta[row].Member3 != null && dataPeserta[row].Member3 != '') {
				cloneMember(totalTender, dataPeserta[row], 3);
			}
			if (dataPeserta[row].Member4 != null && dataPeserta[row].Member4 != '') {
				cloneMember(totalTender, dataPeserta[row], 4);
			}
			if (dataPeserta[row].Member5 != null && dataPeserta[row].Member5 != '') {
				cloneMember(totalTender, dataPeserta[row], 5);
			}
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
	function cloneMember(tenderIndex = null, data = null, rowMember = null) {
		var totalMember = parseInt($("#totalMember"+tenderIndex).val());
		++totalMember;
		var _html = '';
		var member = '';
		var porsi = '';
		if (rowMember == 1) {
			member = data.Member1;
			porsi = data.PorsiMember1;
		} else if (rowMember == 2) {
			member = data.Member2;
			porsi = data.PorsiMember2;
		} else if (rowMember == 3) {
			member = data.Member3;
			porsi = data.PorsiMember3;
		} else if (rowMember == 4) {
			member = data.Member4;
			porsi = data.PorsiMember4;
		} else if (rowMember == 5) {
			member = data.Member5;
			porsi = data.PorsiMember5;
		}
		_html += '<div class="row" id="member-group'+tenderIndex+'-'+totalMember+'">';
			_html += '<div class="col-sm-6">';
				_html += '<div class="form-group">';
					_html += '<label>Member '+totalMember+'</label>';
					_html += '<select class="form-control" name="member-'+tenderIndex+'-'+totalMember+'" id="member-'+tenderIndex+'-'+totalMember+'">';
						$.each($.parseJSON('<?= $pesertaTender ?>'), function(i,v) {
							var selected = (v == member ? 'selected' : '');
							_html += '<option '+selected+' value="'+v+'">'+v+'</option>';
						});
					_html += '</select>';
				_html += '</div>';
			_html += '</div>';
			_html += '<div class="col-sm-6">';
				_html += '<div class="form-group">';
					_html += '<label>Porsi (%)</label>';
					_html += '<input type="number" class="form-control" name="memberPorsi-'+tenderIndex+'-'+totalMember+'" id="memberPorsi-'+tenderIndex+'-'+totalMember+'" placeholder="0" onkeyup="valPorsi(this,\''+tenderIndex+'\')" value="'+porsi+'">';
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
	function bruto(ev, tenderIndex = null) {
		toDecimal(ev);
		if ($("#SDDN").val() == 'LOAN') {
			var bruto = $(ev).val();
			bruto = parseInt(bruto.replace(/,/g, ''));
			var netto = 0;
			if (bruto > 0) {
				netto = (bruto * 10 )/ 100;
			}
			$("#PenawaranNetto"+tenderIndex).val(numeral(netto).format('0,0'));
		}
	}
	function valPorsi(ev, tenderIndex = null) {
		var totalMember = parseInt($("#totalMember"+tenderIndex).val());
		var totalPorsi = 0;
		totalPorsi += parseInt($("#leaderPorsi"+tenderIndex).val());
		for (var i = 1; i <= totalMember; i++) {
			totalPorsi += parseInt($("#memberPorsi-"+tenderIndex+"-"+i).val());
			if(totalPorsi > 100) {
				alert('Porsi pada peserta ini sudah mencapai 100!');
				$(ev).val('');
				break;
			}
		}
	}
</script>