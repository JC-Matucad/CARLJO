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
                    <h1 class="h3 mb-2 text-gray-800">Driver's Profile</h1>
                    
                    <a class="btn btn-primary mb-3" href="#" data-toggle="modal" data-target="#Add_Driver">
                        Add Driver
                    </a>

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

                    <div class="row" id="drivers-div">
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
    <?php $this->load->view('modal/Add_driver'); ?>
    <?php $this->load->view('modal/Delete_driver'); ?>
    <?php $this->load->view('modal/Manage_driver'); ?>
    <?php $this->load->view('Components/scripts'); ?>

    <script>
    $(document).ready(function() {
        function loadEmployee() {
            $.ajax({
                url: '<?= base_url("Control_functions/Get_employee") ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    var driver_div = $('#drivers-div');
                    driver_div.empty();
                    if (Array.isArray(response)) {
                        $.each(response, function(index, driver) {
                            // Check if the driver has a photo
                            var photoUrl = driver.profile ? `<?= base_url("upload/pfp/") ?>${driver.profile}` : '<?= base_url("assets/img/profile_placeholder.jpg") ?>';

                            var driverHtml = `
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-xl-6 col-md-12 h-100 d-flex justify-content-center">
                                                    <img class="mx-auto" src="${photoUrl}" alt="" style="width:120px;height:120px;border:solid 1px black">
                                                </div>

                                                <div class="col-xl-6 col-md-12 h-100 d-flex flex-column justify-content-center">
                                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                                        ${driver.display_name}
                                                    </div>
                                                    <div class="h6 mb-1 font-weight-bold text-gray-800">${driver.car_model}</div>
                                                    <div class="h6 mb-1 font-weight-bold text-gray-800">${driver.car_plate}</div>
                                                    <div class="h6 mb-1 font-weight-bold text-gray-800">${driver.mobile_number}</div>
                                                    <div class="h6 mb-1 font-weight-bold text-gray-800">${driver.email}</div>
                                                </div>

                                                <div class="col-12 d-flex flex-row">
                                                    <a class="btn btn-primary mt-3 w-50 mx-2" style="font-size:15px" href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#Manage_Driver"
                                                    data-ID="${driver.user_id}"
                                                    data-Email="${driver.email}"
                                                    data-Name="${driver.display_name}"
                                                    data-Date_hired="${driver.date_join}"
                                                    data-Position="${driver.position}"
                                                    data-License="${driver.license_number}"
                                                    data-Mobile="${driver.mobile_number}"
                                                    data-Car_model="${driver.car_model}"
                                                    data-Car_plate="${driver.car_plate}"
                                                    data-Address="${driver.address}"
                                                    data-Emergency="${driver.emergency_contact}"
                                                    data-Password="${driver.password}"
                                                    data-Admin="${driver.admin}"
                                                    >
                                                        Manage Driver
                                                    </a>

                                                    <a class="btn btn-danger mt-3 w-50 mx-2" style="font-size:15px" href="#" 
                                                    data-toggle="modal" 
                                                    data-target="#deletedriver_modal"
                                                    data-ID="${driver.user_id}"
                                                    data-profile="${driver.profile}"
                                                    >
                                                        Delete Driver
                                                    </a>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>     
                                </div>
                            `;
                            driver_div.append(driverHtml);
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

        $('#Manage_Driver').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget);
            var modal = $(this);

            modal.find('input[name="inptId"]').val(button.data('id'));
            modal.find('input[name="inptEmail"]').val(button.data('email'));
            modal.find('input[name="inptName"]').val(button.data('name'));
            var dateHired = button.data('date_hired');
            if (dateHired) {
                var formattedDate = new Date(dateHired).toISOString().split('T')[0]; // Format to YYYY-MM-DD
                modal.find('input[name="inptDatehired"]').val(formattedDate);
            }
            modal.find('select[name="inptPosition"]').val(button.data('position'));
            modal.find('input[name="inptLicense"]').val(button.data('license'));
            modal.find('input[name="inptMobile"]').val(button.data('mobile'));
            modal.find('input[name="inptCarmodel"]').val(button.data('car_model'));
            modal.find('input[name="inptPlate"]').val(button.data('car_plate'));
            modal.find('input[name="inptAddress"]').val(button.data('address'));
            modal.find('input[name="inptEmergencyno"]').val(button.data('emergency'));
            modal.find('input[name="inptPassword"]').val(button.data('password'));

            var admin = button.data('admin');
            if (admin == 1) {
                modal.find('input[name="inptAdmin"][value="1"]').prop('checked', true);
            } else {
                modal.find('input[name="inptAdmin"][value="0"]').prop('checked', true);
            }
        });

        $('#deletedriver_modal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget);
            var modal = $(this);
            modal.find('input[name="inptdeleteId"]').val(button.data('id'));
            modal.find('input[name="inptdeleteprofile"]').val(button.data('profile'));
        });
    });
    </script>

</body>

</html>
