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
                    <h1 class="h3 mb-2 text-gray-800">Trip Dashboard</h1>
                    
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
                    <div class="row" id="tickets-div"></div>

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
    <?php $this->load->view('modal/Timein_modal'); ?>
    <?php $this->load->view('modal/Timeout_modal'); ?>
    <?php $this->load->view('Components/scripts'); ?>

    <script>
    $(document).ready(function() {
        function loadEmployee() {
    $.ajax({
        url: '<?= base_url("Control_functions/Get_tickets") ?>',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            var user_id = <?= json_encode($this->session->userdata('User_id')) ?>;
            var ticket_div = $('#tickets-div');
            ticket_div.empty();

            if (Array.isArray(response)) {
                var hasOnTheWay = response.some(ticket => ticket.ticket_status === 'On The way');

                $.each(response, function(index, ticket) {
                    if (ticket.user_id === user_id) {
                        var timeInButtonDisabled = hasOnTheWay ? 'disabled' : '';
                        var timeOutButtonClass = ticket.ticket_status === 'For Pick up' ? 'd-none' : '';

                        var ticketHtml = `
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mx-2">
                                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                                Route : ${ticket.pickup_point_name} - ${ticket.dropoff_point_name}
                                            </div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Time : ${ticket.time_from} - ${ticket.time_to}</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Shift : ${ticket.shift}</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Status : ${ticket.ticket_status}</div>
                                            <a class="btn btn-primary mt-3 w-50 ${timeInButtonDisabled}" style="font-size:15px" href="#" 
                                                data-toggle="modal" 
                                                data-target="#Timeinmodal"
                                                data-ticket_id="${ticket.ticket_id}"
                                                ${timeInButtonDisabled ? 'disabled' : ''}
                                            >
                                                Time in
                                            </a>

                                            <a class="btn btn-primary mt-3 w-50 ${timeOutButtonClass}" style="font-size:15px" href="#" 
                                                data-toggle="modal" 
                                                data-target="#Timeoutmodal"
                                                data-ticket_id="${ticket.ticket_id}"
                                            >
                                                Time out
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        ticket_div.append(ticketHtml);
                    }
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

        $('#Timeinmodal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget); 
            var modal = $(this); 
            var ticketId = button.data('ticket_id');

            modal.find('input[name="inptTicketid"]').val(ticketId);
        });

        $('#Timeoutmodal').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget);
            var modal = $(this); 
            var ticketId = button.data('ticket_id');
            
            modal.find('input[name="inpttimeoutid"]').val(ticketId);
        });
    });
</script>

</body>

</html>
