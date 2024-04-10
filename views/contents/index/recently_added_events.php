<div class="mt-3">
    <h5 class="mb-3">Recently added events</h5>
    <div class="row">
        <?php
        $index = 0;
        foreach ($recentlyAddedEvents as $event) { ?>
            <div class="col-4 <?php if ($index < 2) {
                                    echo "border-end";
                                } ?>">
                <img class="mb-3" style="height: 125px; width: 100%; object-fit: cover" src="/thesis/public/images/cover/<?php echo $event[3] ?>" />
                <p class="m-0 fw-semibold"><?php echo $event[1] ?></p>
                <p style="font-size: 14px;" class="text-secondary"><?php echo $stringUtil->dateAndTime($event[2]) ?></p>
                <p style="height: 100px" class="mb-0 fw-light"><?php if ($event[4] != "") {
                                                                    echo $stringUtil->truncate($event[4]);
                                                                } else {
                                                                    echo "No description";
                                                                } ?></p>
                <a href="/thesis/contents/events?id=<?php echo $event[0] ?>">View</a>
            </div>
        <?php
            $index = $index + 1;
        } ?>
    </div>
</div>