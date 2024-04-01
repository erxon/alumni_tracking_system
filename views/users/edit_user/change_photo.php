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
        </div>
    </div>

</div>