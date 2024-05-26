<p><i class="fas fa-user"></i> Basic information</p>
<form id="basic-information">
    <input hidden id="user-id" name="user-id" value="<?php echo $rows["id"]; ?>" />
    <?php if ($rows["type"] === "admin") { ?>
        <div class="form-floating mb-1">
            <input id="email" class="form-control" type="text" name="email" placeholder="email" value=<?php echo $rows["email"]; ?> />
            <label for="email">email</label>
        </div>
        <button data-bs-toggle="modal" data-bs-target="#basic-information-save-confirm" type="button" class="btn btn-sm btn-outline-dark" id="save-email" disabled>Save</button>
    <?php } else { ?>
        <div class="form-floating mb-1">
            <input id="username" class="form-control" type="text" name="username" placeholder="username" value=<?php echo $rows["username"]; ?> />
            <label for="username">username</label>
        </div>
        <button data-bs-toggle="modal" data-bs-target="#basic-information-save-confirm" type="button" class="btn btn-sm btn-outline-dark" name="basic_information">Save</button>
    <?php } ?>
    <div class="modal fade" id="basic-information-save-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Save changes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to save changes
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button data-bs-dismiss="modal" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>