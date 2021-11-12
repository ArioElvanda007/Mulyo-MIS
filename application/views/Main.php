<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?> - MIS Application</title>
        <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">


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
            .imagePreview {
                width: 100%;
                height: 300px;
                margin-top:10px;    
                margin-right:50px;
                background: url('<?= base_url('assets/images/camera.png') ?>');
                background-position: center center;
                background-size: cover;
                box-shadow : 0px 1px 2px 0px black;
                -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
                -moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
                display: inline-block;
            }
            .imagePreview input.upload {
                position: absolute;
                margin: 0;
                padding: 0;
                font-size: 20px;
                cursor: pointer;
                opacity: 0;
                filter: alpha(opacity=0);
                width: 100%;
                height: 260px;
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

        <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/dist/img/favicon-96x96.png" />
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- NAVBAR -->
            <?php $this->load->view('inc/navbar'); ?>
            <!-- END NAVBAR -->

            <!-- SIDEBAR -->
            <?php $this->load->view('inc/sidebar'); ?>
            <!-- END SIDEBAR -->

            <!-- CONTENT -->
            <div class="content-wrapper">
                <?php $this->load->view($content); ?>
            </div>
            <!-- END CONTENT -->
            <!-- <footer class="main-footer">
                <strong>Copyright &copy; <?= date('Y') ?> </strong> All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
            </footer> -->
        </div>

        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/numeral/numeral.js') ?>"></script>
        <script src="<?= base_url('assets/myjs/blockui.js') ?>"></script>
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
                // DATATABLE
                $("#datatable").DataTable({
                    "responsive": true, 
                    "lengthChange": true, 
                    "autoWidth": false,
                    "order": [[ 0, "asc" ]]
                });

                $("#datatable_nosort").DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                });  

                $("#datatable2").DataTable({
                    "responsive": true, 
                    "lengthChange": true, 
                    "autoWidth": false,
                    "order": [[ 0, "asc" ]],
                });                

                $("#datatable3").DataTable({
                    "responsive": true, 
                    "lengthChange": true, 
                    "autoWidth": false,
                    "order": [[ 0, "asc" ]]
                });  
                
                // SELECT2
                $(".select2").select2();
            })
            function setLoading(init = false) {
                if (init) {
                    $.blockUI({ css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } });
                } else {
                    $.unblockUI();
                }
            }
            function toDecimal(e) {
                $(e).val(numeral($(e).val()).format('0,0'));
            }
            var idleTime = 0;
            $(document).ready(function () {
                var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
                $(this).mousemove(function (e) {
                    idleTime = 0;
                });
                $(this).keypress(function (e) {
                    idleTime = 0;
                });
            });

            function timerIncrement() {
                idleTime = idleTime + 1;
                if (idleTime > 19) { // 20 minutes
                    window.location.href = '<?= site_url("Main/logout") ?>';
                }
            }
        </script>
    </body>
</html>
