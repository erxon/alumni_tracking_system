<form id="change-password" method="post" class="mb-3">
    <p><i class="fas fa-key"></i> Change Password</p>
    <div class="d-flex mb-3">
        <div class="input-group me-2">
            <input id="password" class="form-control" type="password" name="current_password" placeholder="current password" />
            <button disabled id="view-current-password" type="button" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
        </div>
        <div class="input-group">
            <input id="new-password" class="form-control" type="password" name="new_password" placeholder="New Password" />
            <button disabled id="view-new-password" type="button" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
        </div>
    </div>
    <input hidden name="user_id" value=<?php echo $id; ?> />
    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#confirmPasswordChange">Save</button>
    <div class="modal fade" id="confirmPasswordChange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change your password?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="change_password">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>