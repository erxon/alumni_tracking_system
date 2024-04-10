<div class="mt-3">
    <h5 class="mb-3">Survey</h5>
    <?php if (count($newSurvey) > 0) { ?>
        <?php foreach ($newSurvey as $survey) { ?>
            <div class="d-flex align-items-center border p-3 rounded">
                <div class="w-100">
                    <p class="m-0 fw-semibold"><?php echo $survey[1] ?></p>
                    <p style="font-size: 14px;" class="text-secondary"><?php echo $stringUtil->dateAndTime($survey[4]) ?></p>
                </div>
                <a role="button" class="btn btn-sm btn-outline-secondary" href="/thesis/contents/surveys?id=<?php echo $survey[0] ?>">Edit</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="text-secondary">No new survey added</div>
    <?php } ?>

</div>