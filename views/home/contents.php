<div>
    <div class="row">
        <div class="col-lg-4">
            <div class="bg-white p-3" style="border-radius: 10px;">
                <!-------Survey------->
                <h3>Survey for today</h3>
                <?php //if userId in questionId is in result
                $surveyAnswered;
                if ($survey) {
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
                <?php } ?>
                <?php if ($_SESSION["type"] == "admin") { ?>
                    <?php if ($survey) { ?>
                        <form method="post">
                            <input hidden name="delete-action" value="delete" />
                            <button type="submit" class="mt-3 btn btn-sm btn-light">Remove</button>
                        </form>
                    <?php } else { ?>
                        <a class="btn btn-sm btn-dark" role="button" href="/thesis/contents/edit">Add</a>
                    <?php } ?>
                <?php } ?>
            </div>
            <div style="border-radius: 10px;" class="mt-3 bg-white p-3">
                <h3>Events</h3>
                <div class="mt-3">
                    <?php
                    $events = $home->getEvents();

                    foreach ($events as $event) { ?>
                        <p style="font-weight: 500"><?php echo $event[2]; ?></p>
                        <div class="d-flex">
                            <div class="me-3">
                                <p class="mb-0 label">Starts on</p>
                                <p style="font-size: 14px;">
                                    <?php echo $stringUtil->dateAndTime($event[7]); ?>
                                </p>
                            </div>
                            <?php if ($event[8] != "0000-00-00 00:00:00") { ?>
                                <div>
                                    <p class="mb-0 label">Ends on</p>
                                    <p style="font-size: 14px;"><?php echo $stringUtil->dateAndTime($event[8]); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <a role="button" href="/thesis/contents/events?id=<?php echo $event[0]; ?>" class="btn btn-sm btn-light">Details</a>
                        <hr />
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <?php
            $latestNews = $home->getLatestNews();
            $author = $home->getAuthor($latestNews["author"]);
            ?>
            <div class="bg-dark rounded">

                <img class="rounded-top" style="width: 100%; 
                    height: 200px; 
                    object-fit: cover; opacity: 0.25" src="/thesis/public/images/cover/<?php echo $latestNews["coverImage"]; ?>" />
                <div class="p-4" style="z-index: 2">
                    <h1 class="text-light"><?php echo $latestNews["title"]; ?></h1>
                    <p class="text-secondary mb-0"><?php echo $stringUtil->dateAndTime($latestNews["dateCreated"]) ?></p>
                    <p class="text-light"><?php echo $author["firstName"] . " " . $author["lastName"]; ?></p>
                    <p class="text-secondary"><?php echo $latestNews["description"] ?></p>
                    <a role="button" href="/thesis/contents/news?id=<?php echo $latestNews["id"] ?>" class="btn btn-sm btn-light">Read</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-9">
                    <div class="container-fluid row g-0">
                        <?php
                        $news = $home->getNews();
                        foreach ($news as $newsItem) {
                            $author = $home->getAuthor($newsItem[4]);
                        ?>
                            <div class="p-2 col">
                                <div class="card mb-3">
                                    <img src="/thesis/public/images/cover/<?php echo $newsItem[9]; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $newsItem[2] ?></h5>
                                        <p class="card-subtitle text-secondary"><?php echo $stringUtil->dateAndTime($newsItem[5]); ?></p>
                                        <p style="font-size: 14px"><?php echo $author["firstName"] . " " . $author["lastName"] ?></p>
                                        <div class="card-text text-secondary">
                                            <p><?php echo $stringUtil->truncate($newsItem[10]); ?></p>
                                        </div>
                                        <a href="/thesis/contents/news?id=<?php echo $newsItem[0]; ?>" class="btn btn-sm btn-dark">Read</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col">
                    <p class="fw-bold">Archive</p>
                    <a class="d-block text-decoration-none" style="font-style: italic" href="#">Year 2023</a>
                    <a class="d-block text-decoration-none" style="font-style: italic" href="#">Year 2022</a>
                    <a class="d-block text-decoration-none" style="font-style: italic" href="#">Year 2021</a>
                </div>
            </div>

        </div>
    </div>
</div>