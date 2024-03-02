<div>
    <p><i class="fas fa-user"></i> Change photo</p>

    <div>

        <div class="bg-white rounded p-4">
            <?php if (empty($_SESSION["photo"])) { ?>
                <div class="d-flex flex-row align-items-center justify-content-center mb-3">
                    <div class="bg-secondary d-flex flex-row align-items-center justify-content-center" style="border-radius: 100%; height: 120px; width: 120px;">
                        <p class="m-0 text-white" style="font-size: 14px;"><i class="fas fa-image"></i> No picture</p>
                    </div>
                </div>
            <?php } else { ?>
                <div class="d-flex flex-row justify-content-center mb-3">
                    <img style="height: 120px; width: 120px; object-fit: cover; border-radius: 100%;" src="/thesis/public/images/profile/<?php echo $_SESSION["photo"]; ?>" />
                </div>
            <?php } ?>
            <div class="d-flex flex-row justify-content-center">
                <button data-bs-toggle="modal" data-bs-target="#upload-photo" class="btn btn-sm btn-dark"><i class="fas fa-plus me-2"></i> Add Photo</button>
            </div>
        </div>


        <div class="modal fade" id="upload-photo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Upload photo</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/thesis/user/edit/change-photo" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input hidden name="user_id" value="<?php echo $id; ?>" />
                            <input name="profilePhoto" accept="image/jpeg, image/png" class="form-control" type="file" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>