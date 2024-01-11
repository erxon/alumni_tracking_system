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
    <h2 class="mb-3">Contents</h2>
    <p class="mt-0">News, events, and surveys</p>
    <div class="d-flex">
        <div class="me-3">
            <select id="categories" class="form-select">
                <option selected>All</option>
                <option value="events">Events</option>
                <option value="news">News</option>
                <option value="surveys">Surveys</option>
            </select>
        </div>
        <div class="dropdown">
            <a class="btn btn-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-plus"></i> Add Content
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="/thesis/contents/events">
                        <i class="far fa-calendar me-2"></i>Event
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/thesis/contents/news">
                        <i class="far fa-newspaper me-2"></i>News
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/thesis/contents/survey">
                        <i class="fas fa-question me-2"></i>Survey
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <!--Events-->
        <div class="row">
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
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php")
?>