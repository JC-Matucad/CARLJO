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
                <div class="container-fluid py-4" style="max-height: calc(100vh - 56px); overflow-y: auto;">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Trip ticket history</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">History</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Shift </th>
                                            <th>Route</th>
                                            <th>Passenger #</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tbl_ticket as $row): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['ticket_id']) ?></td>
                                                <td><?= htmlspecialchars($row['ticket_status']) ?></td>
                                                <td><?= htmlspecialchars($row['shift']) ?></td>
                                                <td><?= htmlspecialchars($row['pickup_point_name']) ?> - <?= htmlspecialchars($row['dropoff_point_name']) ?></td>
                                                <td><?= htmlspecialchars($row['passenger_count']) ?></td>
                                                <td><?= htmlspecialchars($row['date_scheduled']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('Components/scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "lengthChange": false,
                "pageLength": 8
            });
        });
    </script>

</body>

</html>
