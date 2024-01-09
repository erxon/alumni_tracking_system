<p><i class="fas fa-user"></i> Basic information</p>
<form id="basic-information">
    <div class="form-floating mb-1">
        <input id="username" class="form-control" type="text" name="username" placeholder="username" value=<?php echo $rows["username"]; ?> />
        <label for="username">username</label>
    </div>
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
    <input hidden name="user_id" value=<?php echo $id; ?> />
    <button type="button" id="saveButton" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#confirmationModal">
        Save </button>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="submit" class="btn btn-primary" name="edit_profile" data-bs-dismiss="modal">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>