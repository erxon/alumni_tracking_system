<?php if ($_SESSION["user_id"] == $id) { ?>
    <p><i class="fas fa-user"></i> Basic information</p>
    <form id="basic-information">
        <input hidden id="user-id" name="user-id" value="<?php echo $_SESSION["user_id"]; ?>" />
        <div class="form-floating mb-1">
            <input id="username" class="form-control" type="text" name="username" placeholder="username" value=<?php echo $rows["username"]; ?> />
            <label for="username">username</label>
        </div>
        <?php if ($rows["type"] != "alumni") { ?>
            <div class="form-floating mb-1">
                <input id="first_name" class="form-control" type="text" name="first_name" placeholder="first name" value=<?php echo $rows["firstName"] ?> />
                <label for="first_name">first name</label>
            </div>
            <div class="form-floating mb-1">
                <input id="last_name" class="form-control" type="text" name="last_name" placeholder="last name" value=<?php echo $rows["lastName"] ?> />
                <label for="last_name">last name</label>
            </div>
            <div class="form-floating mb-3">
                <input id="email" class="form-control" type="email" name="email" placeholder="email" value=<?php echo $rows["email"] ?> />
                <label for="email">Email</label>
            </div>
        <?php } ?>
        <button data-bs-toggle="modal" data-bs-target="#basic-information-save-confirm" type="button" class="btn btn-sm btn-outline-dark" name="basic_information">Save</button>
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
    <hr class="mb-3" />
<?php } else { ?>
    <p><i class="fas fa-user"></i> Basic information</p>
    <form id="basic-information">
        <div class="form-floating mb-1">
            <input id="username" class="form-control" type="text" name="username" placeholder="username" value=<?php echo $rows["username"]; ?> />
            <label for="username">username</label>
        </div>
        <div class="form-floating mb-1">
            <input id="first_name" class="form-control" type="text" name="first_name" placeholder="first name" value=<?php echo $rows["firstName"] ?> readonly />
            <label for="first_name">first name</label>
        </div>
        <div class="form-floating mb-1">
            <input id="last_name" class="form-control" type="text" name="last_name" placeholder="last name" value=<?php echo $rows["lastName"] ?> readonly />
            <label for="last_name">last name</label>
        </div>
        <div class="form-floating mb-3">
            <input id="email" class="form-control" type="email" name="email" placeholder="email" value=<?php echo $rows["email"] ?> readonly />
            <label for="email">Email</label>
        </div>
    </form>
<?php } ?>