<div>
    <div class="row">
        <div class="col-lg-4">
            <div style="border-radius: 10px;" class="mt-3 bg-white p-3">
                <h3>Events</h3>
                <div class="rounded p-3 shadow-sm bg-dark text-white">
                    <h5><?php echo $eventHighlight["title"] ?></h5>
                    <div class="d-flex">
                        <div class="me-3">
                            <p class="mb-0 label">Starts on</p>
                            <p style="font-size: 14px;">
                                <?php echo $stringUtil->dateAndTime($eventHighlight["eventStart"]); ?>
                            </p>
                        </div>
                        <?php if ($eventHighlight["eventEnd"] != "0000-00-00 00:00:00") { ?>
                            <div>
                                <p class="mb-0 label">Ends on</p>
                                <p style="font-size: 14px;"><?php echo $stringUtil->dateAndTime($eventHighlight["eventEnd"]); ?></p>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <div class="mt-3">
                    <p class="fw-bold">Other events</p>
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
            $author = $home->getAuthor($newsHighlight["author"]);
            ?>
            <div class="bg-dark rounded">

                <img class="rounded-top" style="width: 100%; 
                    height: 200px; 
                    object-fit: cover; opacity: 0.25" src="/thesis/public/images/cover/<?php echo $newsHighlight["coverImage"]; ?>" />
                <div class="p-4" style="z-index: 2">
                    <h1 class="text-light"><?php echo  $newsHighlight["title"]; ?></h1>
                    <p class="text-secondary mb-0"><?php echo $stringUtil->dateAndTime( $newsHighlight["dateCreated"]) ?></p>
                    <p class="text-light"><?php echo $author["firstName"] . " " . $author["lastName"]; ?></p>
                    <p class="text-secondary"><?php echo  $newsHighlight["description"] ?></p>
                    <a role="button" href="/thesis/contents/news?id=<?php echo $newsHighlight["id"] ?>" class="btn btn-sm btn-light">Read</a>
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