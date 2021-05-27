<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - MIS</title>
	<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<style type="text/css">
		.btn { font-size: 13px !important; }
		input, select { font-size: 13px !important; }
	</style>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>MIS</b> Panel</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<?php if ($this->session->flashdata('login_error')): ?>
					<div class="alert alert-warning" style="font-size: 13px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?= $this->session->flashdata('login_error'); ?>
					</div>
				<?php endif ?>
				<p class="login-box-msg">Silahkan pilih perusahaan</p>
				<div class="row" id="corp-box" style="display: none;">
					<?php
						foreach (['AMK','KGS','KIB','KIP','KSB','KSC','MDH','REN'] as $row => $value): 
					?>
					<div class="col-sm-4 col-4" style="cursor: pointer;" onclick="choosing('<?= $value ?>')">
						<img src="<?= base_url('assets/logo/'.$value.'.png') ?>" class="img-thumbnail animate__animated animate__fadeInUp">
					</div>
					<?php endforeach ?>
				</div>
				<form action="<?= base_url('Auth') ?>" method="post">
					<input type="hidden" name="corp" id="corp" value="PRA">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="username" placeholder="Username">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="password" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<center>
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock-alt"></i> Masuk</button><br />
						<small>version 1.0</small>
					</center>
				</form>
			</div>
		</div>
	</div>

	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
	<script type="text/javascript">
		function choosing(corp) {
			$("#corp").val(corp);
			$(".login-box-msg").html('Silahkan login untuk melanjutkan<br /><b>Kode</b>: '+corp);
			$("#corp-box").hide(200);
			$("form").show(200);
		}
	</script>
</body>
</html>
