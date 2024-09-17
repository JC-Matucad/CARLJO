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
                    <h1 class="h3 mb-2 text-gray-800">Trip ticket</h1>
                    
                    <div id="alert" class="mt-1">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php elseif ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- DataTales Example -->
                    <form action="<?php echo base_url('Control_functions/Add_Ticket'); ?>" method="post" enctype="multipart/form-data">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create Trip ticket</h6>
                        </div>
                        <div class="card-body h-50 row">
                            
                            <div class="col-xl-2 col-md-6 m-2">
                                <label for="driverSelect">Select Driver</label>
                                <select class="form-control" id="driverSelect" name="driverSelect">
                                </select>
                            </div>

                            <div class="col-xl-2 col-md-6 m-2">
                                <label for="">Pick up point</label>
                                <div class="d-flex flex-row">
                                <select class="form-control" id="destinationSelectFrom" name="destinationSelectFrom">
                                </select>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 m-2">
                                <label for="">Drop off</label>
                                <div class="d-flex flex-row">
                                    <select class="form-control" id="destinationSelectTo" name="destinationSelectTo">
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 m-2">
                                <label for="">Shift</label>
                                <div class="d-flex flex-row">
                                    <select class="form-control" id="shiftSelect" name="shiftSelect">
                                        <option value="">Select a Shift</option>
                                        <!-- Add your options here -->
                                        <option value="Incoming AM">Incoming AM</option>
                                        <option value="Incoming PM">Incoming PM</option>
                                        <option value="Outgoing AM">Outgoing AM</option>
                                        <option value="Outgoing PM">Outgoing PM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 m-2">
                                <label for="">Date Schedule</label>
                                <div class="d-flex flex-row">
                                    <input name="inptDatesched" class="form-control" type="date" required>
                                </div>
                            </div>

                            <div class="col-xl-2 col-md-6 m-2 d-flex flex-row justify-content-between">
                                <div class="col-5 p-0">
                                    <label for="">From</label>
                                    <input name="inptTimefrom" class="form-control" type="time" required>
                                </div>
                                <div class="col-5 p-0">
                                    <label for="">To</label>
                                    <input name="inptTimeto" class="form-control" type="time" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body h-50 row">
                            <button type="submit" class="btn btn-primary m-3 w-25">Create</button>
                        </div>
                        
                    </div>
                    </form>

                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Manage Trip ticket</h6>
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
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tbl_ticket as $row): ?>
                                        <tr>
                                            <td><?= $row['ticket_id'] ?></td>
                                            <td><?= $row['ticket_status'] ?></td>
                                            <td><?= $row['pickup_point_name'] ?> - <?= $row['dropoff_point_name'] ?></td>
                                            <td><?= $row['date_scheduled'] ?></td>
                                            <td><?= $row['display_name'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                <a class="btn btn-sm btn-primary mx-1 manageButton" style="font-size:15px" href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#Manage_Ticket"
                                                    data-ticket_id="<?= $row['ticket_id'] ?>"
                                                    data-user_id="<?= $row['user_id'] ?>"
                                                    data-pickup_point="<?= $row['pickup_point'] ?>"
                                                    data-dropoff_point="<?= $row['dropoff_point'] ?>"
                                                    data-shift="<?= $row['shift'] ?>"
                                                    data-passenger_count="<?= $row['passenger_count'] ?>"
                                                    data-date_sched="<?= $row['date_scheduled'] ?>"
                                                    data-time_from="<?= $row['time_from'] ?>"
                                                    data-time_to="<?= $row['time_to'] ?>"
                                                    >
                                                    <i class="fas fa-pen-square"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger mx-1" href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#deleteticket_modal"
                                                    data-ticket_id="<?= $row['ticket_id'] ?>"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
    <?php $this->load->view('modal/Manage_ticket'); ?>
    <?php $this->load->view('modal/Delete_ticket'); ?>
    <?php $this->load->view('Components/scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "searching": false,
                "info": true,
                "lengthChange": false,
                "pageLength": 5
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function loadEmployee() {
                $.ajax({
                    url: '<?= base_url("Control_functions/Get_employee") ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        var driverSelect = $('#driverSelect'); // Target the select element
                        driverSelect.empty(); // Clear existing options
                        driverSelect.append('<option value="">Select a Driver</option>'); // Default option

                        if (Array.isArray(response)) {
                            $.each(response, function(index, driver) {
                                driverSelect.append(`<option value="${driver.user_id}">${driver.display_name}</option>`);
                            });
                        } else {
                            console.error('Expected an array but got:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            }

            function loadDestination() {
                $.ajax({
                    url: '<?= base_url("Control_functions/Get_destination") ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        var destinationSelectFrom = $('#destinationSelectFrom'); // Target the select element
                        var destinationSelectTo = $('#destinationSelectTo'); 
                        destinationSelectFrom.empty();
                        destinationSelectTo.empty(); 
                        destinationSelectFrom.append('<option value="">Select a Pick up point</option>');
                        destinationSelectTo.append('<option value="">Select a Drop off point</option>');

                        if (Array.isArray(response)) {
                            $.each(response, function(index, destination) {
                                destinationSelectFrom.append(`<option value="${destination.destination_id}">${destination.destination}</option>`);
                                destinationSelectTo.append(`<option value="${destination.destination_id}">${destination.destination}</option>`);
                            });
                        } else {
                            console.error('Expected an array but got:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            }

            loadEmployee();
            loadDestination();

            $('#Manage_Ticket').on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var modal = $(this); // The modal itself

                var ticket_id = button.data('ticket_id');
                var user_id = button.data('user_id');
                var pickup_point = button.data('pickup_point');
                var dropoff_point = button.data('dropoff_point');
                var shift = button.data('shift');
                var passenger_count = button.data('passenger_count');
                var datesched = button.data('date_sched');
                var timefrom = button.data('time_from');
                var timeto = button.data('time_to');
                
                modal.find('input[name="inptticketid"]').val(ticket_id);
                modal.find('select[name="driverSelectmodal"]').val(user_id); 
                modal.find('select[name="destinationSelectFrommodal"]').val(pickup_point); 
                modal.find('select[name="destinationSelectTomodal"]').val(dropoff_point); 
                modal.find('select[name="shiftSelect"]').val(shift); 
                modal.find('input[name="inptPassenger"]').val(passenger_count);
                if (datesched) {
                    var formattedDate = new Date(datesched).toISOString().split('T')[0]; // Format to YYYY-MM-DD
                    modal.find('input[name="inptDatesched"]').val(formattedDate);
                }
                if (timefrom) {
                    var formattedTimeFrom = new Date('1970-01-01T' + timefrom).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });
                    modal.find('input[name="inptTimefrom"]').val(formattedTimeFrom);
                }
                if (timeto) {
                    var formattedTimeTo = new Date('1970-01-01T' + timeto).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });
                    modal.find('input[name="inptTimeto"]').val(formattedTimeTo);
                }
            });

            

            $('#deleteticket_modal').on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget);
                var modal = $(this);
                modal.find('input[name="inptdeleteId"]').val(button.data('ticket_id'));
            });

        });

    </script>



</body>

</html>
