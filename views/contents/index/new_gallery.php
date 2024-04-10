<div class="mt-3">
    <h5 class="mb-3">Gallery</h5>
    <?php foreach ($newGallery as $gallery) { ?>
        <div class="d-flex align-items-center border p-3 rounded">
            <div class="w-100">
                <p class="m-0 fw-semibold"><?php echo $gallery[1] ?></p>
                <p style="font-size: 14px;" class="text-secondary"><?php echo $stringUtil->dateAndTime($gallery[3]) ?></p>
            </div>
            <a role="button" class="btn btn-sm btn-outline-secondary" href="/thesis/contents/gallery?id=<?php echo $gallery[0] ?>">Edit</a>
        </div>
    <?php } ?>
</div>