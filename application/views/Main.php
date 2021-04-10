<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?> - MIS</title>
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
        </style>
        <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
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
        <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/numeral/numeral.js') ?>"></script>
        <script type="text/javascript">
            $(function() {
                var title = '<?= $this->session->flashdata("title") ?>';
                var status = '<?= $this->session->flashdata("status") ?>';
                var message = '<?= $this->session->flashdata("message") ?>';
                if(title && status && message) {
                    Swal.fire({
                      icon: status,
                      title: title,
                      text: message
                    })
                }
                // DATATABLE
                $("#datatable").DataTable({
                    "responsive": true, 
                    "lengthChange": true, 
                    "autoWidth": false,
                    "order": [[ 0, "desc" ]]
                });
                // SELECT2
                $(".select2").select2();
            })
            function toDecimal(e) {
                $(e).val(numeral($(e).val()).format('0,0'));
            }
        </script>
    </body>
</html>
