<?php
session_start();
include("/xampp/htdocs/thesis/views/template/header.php");
include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");
?>
<?php
$contents = new Contents();
$events = $contents->getContents("event");
$stringUtil = new StringUltilities();
?>

<div class="main-body-padding">
    <?php include("/xampp/htdocs/thesis/views/contents/contents_nav.php"); ?>
    <div class="row mt-4">
        <?php
        foreach ($events as $event) {
        ?>
            <div class="card m-2 col-md-4 p-0" style="width: 16rem;">
                <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $event[5]; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $event[0]; ?></h5>
                    <div class="card-text">
                        <p style="color: green" class="label mb-0">Starts on</p>
                        <p><?php echo $stringUtil->dateAndTime($event[3]); ?></p>
                        <?php if (!($event[4] == "0000-00-00 00:00:00")) { ?>
                            <p style="color: #f24646" class="label mb-0">Ends on</p>
                            <p><?php echo $stringUtil->dateAndTime($event[4]); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-footer"><a href="/thesis/contents/events?id=<?php echo $event[6]; ?>" class="btn btn-sm btn-dark">Details</a></div>
            </div>
        <?php
        } ?>
    </div>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>