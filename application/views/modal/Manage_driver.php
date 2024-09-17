<div class="modal fade" id="Manage_Driver" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Driver</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    
                <form action="<?php echo base_url('Control_functions/Update_User'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body row">
                        <div class="col-6 mb-3">
                            <input type="hidden" class="form-control" name="inptId" readonly>
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="inptEmail" readonly>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="inptName" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Date Hired</label>
                            <input name="inptDatehired" class="form-control" type="date" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Position</label>
                            <select name="inptPosition" class="form-control">
                                <option>Driver</option>
                                <option>Supervisor</option>
                                <option>Manager</option>
                            </select>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">License Number</label>
                            <input type="text" class="form-control" name="inptLicense" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="number" class="form-control" name="inptMobile" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Car Model</label>
                            <input type="text" class="form-control" name="inptCarmodel" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Plate Number</label>
                            <input type="text" class="form-control" name="inptPlate" required>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="inptAddress" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Emergency Contact</label>
                            <input type="number" class="form-control" name="inptEmergencyno" required>
                        </div>

                        <div class="col-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="inptPassword" required>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <label class="form-label mr-2">Admin :</label>
                            <div class="d-flex flex-row">
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="radio" name="inptAdmin" value="1">
                                    <label class="form-check-label">Yes</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inptAdmin" value="0">
                                    <label class="form-check-label">No</label>
                                </div>
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