<div class="modal fade" id="deletedriver_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">WARNING!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure to delete this user?</div>
                <form id="deleteUserForm" action="<?php echo base_url('Control_functions/Delete_User'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-footer">
                    <input type="hidden" class="form-control" name="inptdeleteId" readonly>
                    <input type="hidden" class="form-control" name="inptdeleteprofile" readonly>
                    <button class="btn btn-danger" type="submit">Delete User</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>