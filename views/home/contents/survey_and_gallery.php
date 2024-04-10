<div style="background-color: #000; height: 275px; padding: 3% 10%;" class="text-white">
    <div class="row me-0">
        <div class="col-6 border-end">
            <div>
                <h3 class="mb-3">Gallery</h3>
                <div style="background: #028fed; height: 100px;" class="rounded p-3 d-flex align-items-center">
                    <div class="w-100">
                        <h5><?php echo $newGallery[0][1]  ?></h5>
                        <p style="font-size: 14px;" class="m-0"><?php echo $stringUtil->dateAndTime($newGallery[0][3]);  ?></p>
                    </div>
                    <a href="/thesis/contents/gallery?id=<?php echo $newGallery[0][0] ?>" role="button" class="btn btn-outline-light">Open</a>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-light mt-4">More</button>
        </div>
        <div class="col-6">
            <h3 class="mb-3">Survey</h3>
            <div style="background: #028fed; height: 100px;" class="rounded p-3 d-flex align-items-center">
                <div class="w-100">
                    <h5><?php echo $newSurvey[0][1]  ?></h5>
                    <p style="font-size: 14px;" class="m-0"><?php echo $stringUtil->dateAndTime($newSurvey[0][3]);  ?></p>
                </div>
                <a href="/thesis/surveys/answers" role="button" class="btn btn-outline-light">Participate</a>
            </div>
            <a role="button" href="/thesis/surveys/answers" class="btn btn-sm btn-outline-light mt-4">More</a>
        </div>
    </div>
</div>