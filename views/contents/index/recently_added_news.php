<div class="mt-3">
    <h5 class="mb-3">Recently added news</h5>
    <div class="row">
        <?php 
        $index = 0;
        foreach ($recentlyAddedNews as $news) { ?>
            <div class="col-4 <?php if($index < 2) { echo "border-end"; }?>">
                <img class="mb-3" style="height: 125px; width: 100%; object-fit: cover" src="/thesis/public/images/cover/<?php echo $news[3] ?>" />
                <p class="m-0 fw-semibold"><?php echo $news[1] ?></p>
                <p style="font-size: 14px;" class="text-secondary"><?php echo $stringUtil->dateAndTime($news[2]) ?></p>
                <p style="height: 100px" class="mb-0 fw-light"><?php if ($news[4] != "") {
                                                                    echo $stringUtil->truncate($news[4]);
                 } else { echo "No description"; } ?></p>
                <a href="/thesis/contents/news?id=<?php echo $news[0] ?>">View</a>
            </div>
        <?php
        $index = $index + 1;
     } ?>
    </div>
</div>