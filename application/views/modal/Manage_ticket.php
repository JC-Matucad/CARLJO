<div class="modal fade" id="Manage_Ticket" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Driver</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    
                <form action="<?php echo base_url('Control_functions/Update_Ticket'); ?>" method="post" enctype="multipart/form-data">
                <div class="card-body h-50 row">
                            
                            <div class="col-6 mb-2">
                                <input type="hidden" class="form-control" name="inptticketid" required>
                                <label for="driverSelect">Select Driver</label>
                                <select class="form-control" id="driverSelectmodal" name="driverSelectmodal">
                                </select>
                            </div>
                            
                            <div class="col-6 mb-2">
                                <label for="">Pick up point</label>
                                <div class="d-flex flex-row">
                                <select class="form-control" id="destinationSelectFrommodal" name="destinationSelectFrommodal">
                                </select>
                                </div>
                            </div>
                            
                            <div class="col-6 mb-2">
                                <label for="">Drop off</label>
                                <div class="d-flex flex-row">
                                    <select class="form-control" id="destinationSelectTomodal" name="destinationSelectTomodal">
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-6 mb-2">
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
                            
                            <div class="col-6 mb-2">
                                <label class="form-label">Passenger Count</label>
                                <input type="number" class="form-control" name="inptPassenger" required>
                            </div>
                            
                            <div class="col-6 mb-2">
                                <label for="">Date Schedule</label>
                                <div class="d-flex flex-row">
                                    <input name="inptDatesched" class="form-control" type="date" required>
                                </div>
                            </div>

                            <div class="col-12 mb-2 d-flex flex-row justify-content-between">
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
                    <div class="modal-body row justify-content-around">
                        <button class="btn btn-primary col-xl-5 col-md-12 mb-2" type="submit">Update</button>
                        <button class="btn btn-secondary col-xl-5 col-md-12" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function loadEmployee() {
                $.ajax({
                    url: '<?= base_url("Control_functions/Get_employee") ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        var driverSelect = $('#driverSelectmodal'); // Target the select element
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
                        var destinationSelectFrom = $('#destinationSelectFrommodal'); // Target the select element
                        var destinationSelectTo = $('#destinationSelectTomodal'); 
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
        });

    </script>