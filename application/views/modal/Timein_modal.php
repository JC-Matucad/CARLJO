<div class="modal fade" id="Timeinmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attendance</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?php echo base_url('Control_functions/Time_in'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <label class="text-lg">Please upload a proof of your trip</label>
                    
                    <input type="file" name="uploaded_file" id="uploaded_file" accept="image/*" capture="camera" style="display:none;" 
                        onchange="previewImage(event)" />

                    <a href="#" class="card rounded w-75 d-flex justify-content-center align-items-center" style="height:150px; border:2px dashed gray; text-decoration:none;color:inherit;" onclick="document.getElementById('uploaded_file').click(); return false;">
                        <i class="fas fa-cloud-upload-alt" style="font-size:50px;color:#567DE2"></i>
                        <label style="font-size:13px;">Click to open camera</label>
                    </a>
                    
                    <p id="file-name" style="margin-top: 10px;"></p>
                    <img id="image-preview" style="max-width: 100%; height: auto; display: none; margin-top: 10px;" />
                </div>

                <div class="modal-body d-flex flex-row justify-content-center align-items-center">
                    <div class="mx-1 d-flex flex-column justify-content-center align-items-center w-75">
                        <input name="inptTicketid" id="inptTicketid" class="form-control mb-4 text-center" type="hidden" readonly>
                        <input name="current_time" id="current-time" class="form-control mb-4 text-center" type="text" readonly>
                        <button class="btn btn-primary w-100" type="submit">Time in</button>
                    </div>
                </div>
            </form>

            <div class="modal-body d-flex flex-row justify-content-center align-items-center">
                <label style="font-size:17px">Reminder: Always complete your trip ticket before starting a new one.</label>
            </div>
        </div>
    </div>
</div>

<script>
    
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            var imagePreview = document.getElementById('image-preview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
            document.getElementById('file-name').textContent = file.name;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Update time every second
    function formatTimein(date) {
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        return hours + ':' + minutes + ':' + seconds;
    }

    function updateTimein() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        currentTimeElement.value = formatTimein(now);
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateTimein();
        setInterval(updateTimein, 1000);

        // Show the selected file name when uploaded
        document.getElementById('uploaded_file').addEventListener('change', function(){
            const fileName = this.files[0] ? this.files[0].name : 'No file selected';
            document.getElementById('file-name').textContent = fileName;
        });
    });
</script>
