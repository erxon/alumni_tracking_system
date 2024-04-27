<div>
    <?php include "carousel.php" ?>
    <div class="row dashboard me-0">
        <div class="col-lg-4 border-end">
            <div style="border-radius: 10px;" class="mt-3">
                <h3>Events</h3>
                <div class="mt-3">
                    <?php
                    $events = $home->getEvents();
                    foreach ($events as $event) {
                        if ($event[0] != $eventHighlight["eventHighlight"]) {
                    ?>
                            <div class="p-3 bg-white mb-3 rounded">
                                <h5><?php echo $event[2]; ?></h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <p class="mb-0 label">Starts on</p>
                                        <p style="font-size: 14px;">
                                            <?php echo $stringUtil->dateAndTime($event[6]); ?>
                                        </p>
                                    </div>
                                    <?php if ($event[7] != "0000-00-00 00:00:00") { ?>
                                        <div>
                                            <p class="mb-0 label">Ends on</p>
                                            <p style="font-size: 14px;"><?php echo $stringUtil->dateAndTime($event[8]); ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <a role="button" href="/thesis/contents/events?id=<?php echo $event[0]; ?>" class="btn btn-sm btn-dark">Details</a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <a role="button" href="/thesis/contents/events/all" class="btn btn-sm btn-dark">See more</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="mt-3">
                <div>
                    <div class="row g-1">
                        <h3>News</h3>
                        <?php
                        $news = $home->getNews();
                        foreach ($news as $newsItem) {
                            if ($newsItem[0] != $newsHighlight["newsHighlight"]) {
                        ?> 
                                <div class="col-4">
                                    <div class="card mb-3">
                                        <img src="/thesis/public/images/cover/<?php echo $newsItem[8]; ?>" class="card-img-top" alt="...">
                                        <div class="card-body d-flex flex-column" style="height: 240px;">
                                            <div class="h-100">
                                                <h5 class="card-title"><?php echo $newsItem[2] ?></h5>
                                                <p style="font-size: 14px;"><?php echo $stringUtil->dateAndTime($newsItem[5]); ?></p>
                                                <div class="card-text">
                                                    <p class="fw-light" style="font-size: 14px"><?php echo $stringUtil->truncate($newsItem[9], 50); ?></p>
                                                </div>
                                            </div>
                                            <a href="/thesis/contents/news?id=<?php echo $newsItem[0]; ?>" class="btn btn-sm btn-dark d-block">Read</a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
                <a role="button" href="/thesis/contents/news/all" class="btn btn-sm btn-dark">See more</a>
            </div>

        </div>
    </div>
    <?php include "survey_and_gallery.php" ?>
</div>