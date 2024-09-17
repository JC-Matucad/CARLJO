<div class="modal fade" id="Timeoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form id="deleteUserForm" action="<?php echo base_url('Control_functions/Time_out'); ?>" method="post" enctype="multipart/form-data"> 
                <div class="modal-body">
                    <label class="form-label mb-4">Please enter the number of passengers to complete the ticket.</label>
                    <label class="form-label mb-2">Passenger Count <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="inptpassengercount" required>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" name="inpttimeoutid" readonly>
                    <input name="timeforout" id="timeforout" class="form-control mb-4 text-center" type="hidden" readonly>
                    <button class="btn btn-primary" type="submit">Complete</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    

<script>
    function formatTime(date) {
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        return hours + ':' + minutes + ':' + seconds;
    }

    function updateTime() {
        const currentTimeElement = document.getElementById('timeforout');
        const now = new Date();
        currentTimeElement.value = formatTime(now);
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateTime();
        setInterval(updateTime, 1000);
    });
</script>