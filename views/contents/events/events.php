<?php
session_start();

include "/xampp/htdocs/thesis/models/Contents.php";
include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$contents = new Contents();
$events = $contents->getContents("event");
$stringUtil = new StringUltilities();
?>

<?php
include "/xampp/htdocs/thesis/views/template/header.php";
?>
<?php if ($_SESSION["type"] == "admin") { ?>
    <?php include "/xampp/htdocs/thesis/views/contents/layout/header.php" ?>
    <div class="mt-4 py-3">
        <a class="btn btn-sm btn-dark mb-2" href="/thesis/contents/events"><i class="far fa-calendar me-2"></i>Add event</a>
        <div class="row g-2">
            <?php
            foreach ($events as $event) {
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card p-0">
                        <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $event[5]; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $event[0]; ?></h5>
                            <div style="height: 175px">
                                <?php if ($event[7] != "") { ?>
                                    <p class="fw-light" style="font-size:14px"><?php echo $stringUtil->truncate($event[7]); ?></p>
                                <?php } ?>
                                <div style="font-size: 14px;" class="bg-success bg-opacity-75 text-white p-1 rounded">
                                    <p class="m-0 fw-semibold">Starts on</p>
                                    <p class="m-0"><?php echo $stringUtil->dateAndTime($event[3]); ?></p>
                                </div>
                                <?php if (!($event[4] == "0000-00-00 00:00:00")) { ?>
                                    <div style="font-size: 14px;" class="bg-danger bg-opacity-75 text-white p-1 rounded mt-1">
                                        <p class="m-0">Ends on</p>
                                        <p class="m-0"><?php echo $stringUtil->dateAndTime($event[4]); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer"><a href="/thesis/contents/events?id=<?php echo $event[6]; ?>" class="btn btn-sm btn-dark">Details</a></div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
<?php } else { ?>
    <div class="main-body-padding surveys" style="margin-top: 5%">
        <h1 class="mb-3">Events</h1>
        <div class="row g-1">
            <?php
            foreach ($events as $event) {
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card p-0">
                        <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $event[5]; ?>" class="card-img-top">
                        <div class="card-body" style="height: 240px">
                            <h5 class="card-title"><?php echo $event[0]; ?></h5>
                            <div>
                                <?php if ($event[7] != "") { ?>
                                    <p class="fw-light" style="font-size:14px"><?php echo $stringUtil->truncate($event[7]); ?></p>
                                <?php } ?>
                                <div style="font-size: 14px;" class="bg-success bg-opacity-75 text-white p-1 rounded">
                                    <p class="m-0 fw-semibold">Starts on</p>
                                    <p class="m-0"><?php echo $stringUtil->dateAndTime($event[3]); ?></p>
                                </div>
                                <?php if (!($event[4] == "0000-00-00 00:00:00")) { ?>
                                    <div style="font-size: 14px;" class="bg-danger bg-opacity-75 text-white p-1 rounded mt-1">
                                        <p class="m-0">Ends on</p>
                                        <p class="m-0"><?php echo $stringUtil->dateAndTime($event[4]); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer"><a href="/thesis/contents/events?id=<?php echo $event[6]; ?>" class="btn btn-sm btn-dark">Details</a></div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
<?php } ?>

<?php
include "/xampp/htdocs/thesis/views/contents/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>