<form id="change-password" class="mb-3">
    <p><i class="fas fa-key"></i> Change Password</p>
    <div class="form-floating mb-1">
        <input id="password" class="form-control" type="password" name="current_password" placeholder="current password" />
        <label for="password">Current password</label>
    </div>
    <div class="form-floating mb-3">
        <input id="new-password" class="form-control" type="password" name="new_password" placeholder="New Password" />
        <label for="new-password">New password</label>
    </div>
    <input hidden name="user_id" value=<?php echo $id; ?> />
    <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#confirmPasswordChange">Save</button>
    <div class="modal fade" id="confirmPasswordChange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    asdfsadfsaasdfdsasdf
                    asdfsasdfdsasdfdsasd
                    sdfdsasdffdsasdfdsas
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="change_password">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>