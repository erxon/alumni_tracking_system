<div>
    <div class="row">
        <div class="col-lg-4">

            <div class="bg-white p-3" style="border-radius: 10px;">
                <!-------Survey------->
                <h3>Survey for today</h3>
                <?php //if userId in questionId is in result
                $surveyAnswered;
                if (isset($survey)) {
                    $surveyAnswered = $home->userAnsweredSurvey($_SESSION["user_id"], $survey["survey"]);
                }

                if (isset($surveyAnswered)) {
                ?>
                    <div>You have already answered the survey for today.</div>
                <?php } else { ?>
                    <?php if (isset($surveyQuestion)) { ?>
                        <div class="survey-container" class="mb-3">
                            <form id="survey-answer-form">
                                <input hidden name="survey_answer" value="survey_answer" />
                                <input hidden name="survey_question" value="<?php echo $surveyQuestion["id"]; ?>" />
                                <div class="mb-3">
                                    <h5><?php echo $surveyQuestion["question"]; ?></h5>
                                    <img style="width: 100%; height: 200px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $surveyQuestion["coverImage"]; ?>" />
                                    <?php echo $surveyQuestion["body"]; ?>
                                    <?php for ($i = 0; $i < count($surveyAnswers); $i++) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer" value="<?php echo $surveyAnswers[$i][0]; ?>" id="answer<?php echo $i ?>">
                                            <label class="form-check-label" for="answer<?php echo $i ?>">
                                                <?php echo $surveyAnswers[$i][2]; ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                                <button type="submit" class="btn btn-sm btn-dark">Submit answer</button>
                            </form>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION["type"] == "admin") { ?>
                        <?php if (isset($survey)) { ?>
                            <form method="post">
                                <input hidden name="delete-action" value="delete" />
                                <button type="submit" class="mt-3 btn btn-sm btn-light">Remove</button>
                            </form>
                        <?php } else { ?>
                            <a class="btn btn-sm btn-dark" role="button" href="/thesis/contents/edit">Add</a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>


            </div>
        </div>
        <div class="col-lg-8">
        </div>
    </div>
</div>