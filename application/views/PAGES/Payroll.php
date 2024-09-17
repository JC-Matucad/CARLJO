<?php $this->load->view('Components/header'); ?>
<body id="page-top" style="overflow:hidden">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('Components/sidebar'); ?>

        <div id="content-wrapper" class="d-flex flex-column" style="overflow:hidden">
            <div id="content">
                <!-- Topbar -->
                <?php $this->load->view('Components/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="d-flex flex-column justify-content-center m-5">
                        <div class="error" data-text="ERROR">ERROR</div>
                        <p class="lead text-gray-800 mb-5">Page Not found</p>
                        <p class="text-gray-500 mb-0">Please come back soon</p>
                        <a href="<?= site_url('Menu/index') ?>">&larr; Back to Dashboard</a>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    
    <?php $this->load->view('Logout_modal'); ?>
    <?php $this->load->view('Components/scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "searching": false,
                "info": true,
                "lengthChange": false,
                "pageLength": 8
            });
        });
    </script>

</body>

</html>
