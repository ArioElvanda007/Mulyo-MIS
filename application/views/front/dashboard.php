<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard AIS Application</title>
	<link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css') ?>">

	<style type="text/css">
		.nav-item > a.nav-link > p { font-size: 13px !important; }
		footer.main-footer { font-size: 13px !important; }
		.nav-item > a { font-size: 13px !important; }
		h3 { font-size: 28px !important; }
		h4 { font-size: 18px !important; }
		h1 { font-size: 25px !important; }
		p, a { font-size: 13px !important; }
		.ml-30 { margin-left: 34px !important; }
		.btn { font-size: 13px !important; }
		input, select, textarea, label, 
		table > thead > tr > th { font-size: 12px !important; }
		table > thead > tr > th { text-align: center; }
		table > tbody > tr > td {
			font-size: 12px !important;
			padding: 5px !important;
		}
		input, select, textarea { border-radius: 0 !important; }
		.btn-warning { color: white !important; }
		legend { border-bottom: 1px solid black }
		body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
			margin-left: 0 !important;
		}
	</style>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
	<script type="text/javascript">
		var preview = function(el) {
			if (el.files && el.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$(el).parent().css({'background-image': 'url('+e.target.result+')','background-size':'cover','background-position': 'center center'});
				}
				reader.readAsDataURL(el.files[0]);
			}
		}
	</script>
</head>
<body class="hold-transition dark-mode">
	<div class="wrapper">
		<!-- NAVBAR -->
		<?php $this->load->view('inc/navbar_dashboard'); ?>
		<!-- END NAVBAR -->

		<!-- CONTENT -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Dashboard</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Monthly Recap Report</h5>

									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<p class="text-center">
												<strong>Data Job 3 tahun terakhir</strong>
											</p>
											<br /><br />
											<div class="chart">
												<canvas id="sumJob" height="300" style="height: 300px;"></canvas>
											</div>
											<!-- /.chart-responsive -->
										</div>
										<!-- /.col -->
										<div class="col-md-6">
											<select class="form-control" style="width: 20%;float: right;" id="countJob_year" onchange="countJob()">
												<?php foreach (range(date('Y'), (date('Y') - 2)) as $row => $value): ?>
												<option value="<?= $value ?>"><?= $value ?></option>
											<?php endforeach ?>
										</select>
										<p class="text-center">
											<strong>Total Job</strong>
										</p>
										<br /><br />
										<div class="chart">
											<canvas id="countJob" height="300" style="height: 300px;"></canvas>
										</div>
									</div>
									<!-- /.col -->
								</div>
								<!-- /.row -->
							</div>
							<!-- ./card-body -->
							<div class="card-footer">
								<div class="row">
									<div class="col-sm-3 col-6">
										<div class="description-block border-right">
											<span class="description-percentage <?= ($totalProject < $target->TargetInfo ? 'text-danger' : 'text-success') ?>">Target <?= number_format($target->TargetInfo) ?></span>
											<h5 class="description-header"><?= $totalProject ?></h5>
											<span class="description-text">TOTAL PROJECT</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-sm-3 col-6">
										<div class="description-block border-right">
											<span class="description-percentage text-info"><?= ($rap->total ? $rap->total : '&nbsp') ?></span>
											<h5 class="description-header"><?= $rap->penyerapan ?></h5>
											<span class="description-text">PENYERAPAN RAP</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-sm-3 col-6">
										<div class="description-block border-right">
											<span class="description-percentage text-success">&nbsp;</span>
											<h5 class="description-header">0</h5>
											<span class="description-text">NILAI MARGIN</span>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-sm-3 col-6">
										<div class="description-block">
											<span class="description-percentage text-success">&nbsp;</span>
											<h5 class="description-header"><?= number_format($totalProject_pelaksana) ?></h5>
											<span class="description-text">PELAKSANAAN PROJECT</span>
										</div>
										<!-- /.description-block -->
									</div>
								</div>
								<!-- /.row -->
							</div>
							<!-- /.card-footer -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
				</div>

				<!-- SECTION 2 -->
				<div class="row">
					<!-- Left col -->
					<div class="col-md-4">
						<!-- MAP & BOX PANE -->
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Visitors Report</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body p-0">
								<div class="d-md-flex">
									<div class="p-1 flex-fill" style="overflow: hidden">
										<!-- Map will be created here -->
										<div id="world-map-markers" style="height: 325px; overflow: hidden">
											<div class="map"></div>
										</div>
									</div>
								</div><!-- /.d-md-flex -->
							</div>
							<!-- /.card-body -->
						</div>
					</div>
					<div class="col-sm-8">
						<div class="card">
							<div class="card-header border-transparent">
								<h3 class="card-title">10 Project Terbaru</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<thead>
											<tr>
												<th>Job No</th>
												<th>Nama Job</th>
												<th>Status</th>
												<th>Netto</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($jobs as $row => $value): ?>
												<tr>
													<td><?= $value->JobNo ?></td>
													<td><?= $value->JobNm ?></td>
													<?php
														$badge = 'badge-info';
														if ($value->StatusJob == 'Pelaksanaan' || $value->StatusJob == 'Pemeliharaan') {
															$badge = 'badge-success';
														} elseif ($value->StatusJob == 'Proposal') {
															$badge = 'badge-warning';
														} else {
															$badge = 'badge-danger';
														}
													?>
													<td><span class="badge <?= $badge ?>"><?= $value->StatusJob ?></span></td>
													<td>
														<?= number_format(ceil($value->Netto)) ?>
													</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-footer clearfix">
								<a href="<?= site_url('Main') ?>" class="btn btn-sm btn-info float-right">Lihat Selengkapnya</a>
							</div>
							<!-- /.card-footer -->
						</div>
					</div>
				</section>
			</div>
			<!-- END CONTENT -->
			<footer class="main-footer">
				<strong>Copyright &copy; <?= date('Y') ?> </strong> All rights reserved.
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 1.0.0
				</div>
			</footer>
		</div>

		<script>
			$.widget.bridge('uibutton', $.ui.button)
		</script>
		<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
		<script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
		<!-- FOR DASHBOARD -->
		<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/raphael/raphael.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/jquery-mapael/jquery.mapael.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/jquery-mapael/maps/usa_states.min.js') ?>"></script>
		<script type="text/javascript">
			function setMessage(status, title, message) {
				Swal.fire({
					icon: status,
					title: title,
					text: message
				})
			}
			$(function() {
				var title = '<?= $this->session->flashdata("title") ?>';
				var status = '<?= $this->session->flashdata("status") ?>';
				var message = '<?= $this->session->flashdata("message") ?>';
				if(title && status && message) {
					setMessage(status, title, message);
				}
				// CALlING MAPS
				$('#world-map-markers').mapael({
					map: {
						name: 'usa_states',
						zoom: {
							enabled: true,
							maxLevel: 10
						}
					}
				})
		        // CALLING CHARTS
		        sumJob();
		        countJob();
		    })
			function countJob() {
				var countJob_year = $("#countJob_year").val();
				$.ajax({
					url: '<?= site_url('Dashboard/chart_two') ?>',
					type: 'POST',
					data: { year: countJob_year },
					success:function(res) {
						var resp = $.parseJSON(res);
						var salesChartCanvas = $('#countJob').get(0).getContext('2d')
						var salesChartData = {
							labels: ['Total','Proposal','Menang','Gagal'],
							datasets: [
							{
								label: 'Value',
								borderColor: 'rgba(60,179,133,0.8)',
								pointRadius: true,
								pointColor: '#3b8bba',
								data: resp,
								fill: false
							}
							]
						}

						var salesChartOptions = {
							maintainAspectRatio: false,
							responsive: true,
							legend: {
								display: false
							},
							scales: {
								xAxes: [{
									gridLines: {
										display: false
									}
								}],
								yAxes: [{
									gridLines: {
										display: false
									},
									ticks: {
										userCallback: function(value, index, values) {
                                    return value.toLocaleString();   // this is all we need
                                }
                            }
                        }]
                    },
                    tooltips: {
                    	callbacks: {
                    		label: function(tooltipItem, data) {
                    			var value = data.datasets[0].data[tooltipItem.index];
                    			value = value.toString();
                    			value = value.split(/(?=(?:...)*$)/);
                    			value = value.join(',');
                    			return value;
                    		}
                      } // end callbacks:
                  },
              }
              var salesChart = new Chart(salesChartCanvas, {
              	type: 'line',
              	data: salesChartData,
              	options: salesChartOptions
              }
              )
          }
      })
			}
			function sumJob() {
				var nettoData = JSON.parse('<?= $one ?>');
				var salesChartCanvas = $('#sumJob').get(0).getContext('2d')
				var salesChartData = {
					labels: nettoData.years,
					datasets: [
					{
						label: 'Netto',
						backgroundColor: 'rgba(60,141,188,0.9)',
						borderColor: 'rgba(60,141,188,0.8)',
						pointRadius: false,
						pointColor: '#3b8bba',
						pointStrokeColor: 'rgba(60,141,188,1)',
						pointHighlightFill: '#fff',
						pointHighlightStroke: 'rgba(60,141,188,1)',
						data: nettoData.datas
					}
					]
				}

				var salesChartOptions = {
					maintainAspectRatio: false,
					responsive: true,
					legend: {
						display: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								display: false
							}
						}],
						yAxes: [{
							gridLines: {
								display: false
							},
							ticks: {
								userCallback: function(value, index, values) {
                            return value.toLocaleString();   // this is all we need
                        }
                    }
                }]
            },
            tooltips: {
            	callbacks: {
            		label: function(tooltipItem, data) {
            			var value = data.datasets[0].data[tooltipItem.index];
            			value = value.toString();
            			value = value.split(/(?=(?:...)*$)/);
            			value = value.join(',');
            			return value;
            		}
              } // end callbacks:
          },
      }
      var salesChart = new Chart(salesChartCanvas, {
      	type: 'bar',
      	data: salesChartData,
      	options: salesChartOptions
      }
      )
  }
</script>
</body>
</html>
