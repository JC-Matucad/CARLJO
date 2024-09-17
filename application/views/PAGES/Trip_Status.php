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
                    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Trip Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Route</th>
                                            <th>Date</th>
                                            <th>Driver</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tbl_ticket as $row): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['ticket_id']) ?></td>
                                                <td><?= htmlspecialchars($row['ticket_status']) ?></td>
                                                <td><?= htmlspecialchars($row['pickup_point_name']) ?> - <?= htmlspecialchars($row['dropoff_point_name']) ?></td>
                                                <td><?= htmlspecialchars($row['date_scheduled']) ?></td>
                                                <td><?= htmlspecialchars($row['display_name']) ?></td>
                                                <td><?= htmlspecialchars($row['mobile_number']) ?></td>
                                                <td>
                                                <div class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-success mx-1" href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#Ticketstatus_modal"
                                                    data-timein="<?= $row['time_in'] ?>"
                                                    data-timeout="<?= $row['time_out'] ?>"
                                                    data-passenger="<?= $row['passenger_count'] ?>"
                                                    data-proof="<?= $row['proof_image'] ?>"
                                                >
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
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

    
    <?php $this->load->view('Logout_modal'); ?>
    <?php $this->load->view('modal/Ticket_statusmodal'); ?>
    <?php $this->load->view('Components/scripts'); ?>

    <script>
    $('#Ticketstatus_modal').on('show.bs.modal', function (e) {
        var baseUrl = '<?= base_url() ?>';
        var button = $(e.relatedTarget);
        var modal = $(this);

        var timein = button.data('timein');
        var timeout = button.data('timeout');
        var passenger = button.data('passenger');
        var proof = button.data('proof');

        var proofImageUrl = proof ? baseUrl + 'upload/proof/' + proof : baseUrl + 'assets/img/proof_placeholder.png'; // Use placeholder if proof is empty or not available

        console.log('Proof Image URL:', proofImageUrl); // Verify the URL in the console

        modal.find('#timein').text(timein);
        modal.find('#timeout').text(timeout);
        modal.find('#passenger').text(passenger);
        modal.find('#prooftxt').text(proofImageUrl); // Display the URL as text
        modal.find('#proofImage').attr('src', proofImageUrl); // Set the image source
    });
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
