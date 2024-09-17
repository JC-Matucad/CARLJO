<div class="modal fade" id="Profile_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <img class="mx-auto" alt="" style="width:120px;height:120px;border:solid 1px black" src="<?= $this->session->userdata('Pfp_filename') ? base_url("upload/pfp/" . $this->session->userdata('Pfp_filename')) : base_url("assets/img/profile_placeholder.jpg") ?>" >
                        </div>
                        <div class="col-6 mb-3">
                            <input type="hidden" class="form-control" name="inptId" readonly>
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="inptEmail" value="<?= $this->session->userdata('Email') ?>" readonly>

                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="inptName" value="<?= $this->session->userdata('Display_name') ?>" readonly>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">License Number</label>
                            <input type="text" class="form-control" name="inptLicense" value="<?= $this->session->userdata('License_no') ?>" readonly>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="number" class="form-control" name="inptMobile" value="<?= $this->session->userdata('Mobile') ?>" readonly>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Car Model</label>
                            <input type="text" class="form-control" name="inptCarmodel" value="<?= $this->session->userdata('Model') ?>" readonly>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Plate Number</label>
                            <input type="text" class="form-control" name="inptPlate" value="<?= $this->session->userdata('Plate') ?>" readonly>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="inptAddress" value="<?= $this->session->userdata('Address') ?>" readonly>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Emergency Contact</label>
                            <input type="number" class="form-control" name="inptEmergencyno" value="<?= $this->session->userdata('Emergency_contact') ?>" readonly>
                        </div>
                </div>
                
                <div class="modal-body row justify-content-around">
                    <button class="btn btn-secondary col-xl-5 col-md-11" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    