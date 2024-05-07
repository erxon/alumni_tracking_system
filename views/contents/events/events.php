<?php
session_start();

include "/xampp/htdocs/thesis/models/Contents.php";
include "/xampp/htdocs/thesis/models/utilities/StringUtilities.php";

$contents = new Contents();
$events = $contents->getContents("event");
$stringUtil = new StringUltilities();
$page = 0;
$numberOfItemsPerPage = 4;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["sort"])) {
        $events = $contents->getEvents($_GET["sort"]);
    }
    if (isset($_GET["title"])) {
        $events = $contents->getEventsByTitle($_GET["title"]);
    }
}

?>

<?php
include "/xampp/htdocs/thesis/views/template/header.php";
?>
<?php if ($_SESSION["type"] == "admin") { ?>
    <?php include "/xampp/htdocs/thesis/views/contents/layout/header.php" ?>
    <div class="mt-4 py-3">
        <a class="btn btn-sm btn-dark mb-2" href="/thesis/contents/events"><i class="far fa-calendar me-2"></i>Add event</a>
        <div class="d-flex mb-3">
            <form method="get" class="me-2">
                <div class="d-flex">
                    <input hidden name="page" value="<?php echo $page ?>" />
                    <select id="filter-table" name="sort" class="form-select me-2" aria-label="Default select example">
                        <option selected value="">Open this select menu</option>
                        <option <?php if (isset($_GET["sort"]) && $_GET["sort"] == "DESC") {
                            echo "selected";
                        } ?> value="DESC">Newest</option>
                        <option <?php if (isset($_GET["sort"]) && $_GET["sort"] == "ASC") {
                            echo "selected";
                        } ?> value="ASC">Oldest</option>
                    </select>
                    <button disabled id="filter-table-button" class="btn btn-sm btn-dark" type="submit">Sort</button>
                </div>
            </form>
            <form method="get" class="me-2">
                <div class="d-flex">
                    <input hidden name="page" value="<?php echo $page ?>" />
                    <input id="title" placeholder="Event name" class="form-control me-2" name="title" value="" />
                    <button disabled id="search-by-name" class="btn btn-sm btn-dark">Search</button>
                </div>
            </form>
            <button id="reload-page" class="btn btn-sm btn-dark">Reset</button>
        </div>
        <table class="table table-striped" style="font-size: 14px;">
            <thead>
                <th>No.</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php
                $number = 1;
                for ($i = ($page - 1) * $numberOfItemsPerPage; $i < ($page * $numberOfItemsPerPage) && $i < count($events); $i++) {
                    ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td><?php echo $events[$i][0]; ?></td>
                        <td><?php echo $stringUtil->dateAndTime($events[$i][3]); ?></td>
                        <td><?php if (!($events[$i][4] == "0000-00-00 00:00:00")) {
                            echo $stringUtil->dateAndTime($events[$i][4]);
                        } else {
                            echo "No end date specified";
                        } ?></td>
                        <td>
                            <a href="/thesis/contents/events?id=<?php echo $events[$i][5]; ?>"
                                class="btn btn-sm btn-dark">Details</a>
                        </td>
                    </tr>
                    <?php
                    $number++;
                } ?>
            </tbody>
        </table>
        <?php if (count($events) > $numberOfItemsPerPage) { ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1) { ?>
                        <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["sort"])) {
                            echo "/thesis/contents/events/all?page=" . ($page - 1) . "&sort=" . $_GET["sort"];
                        } else {
                            echo "/thesis/contents/events/all?page=" . $page - 1;
                        } ?>>
                                Previous</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i < ceil(count($events) / $numberOfItemsPerPage) + 1; $i++) { ?>
                        <?php if (isset($_GET["sort"])) { ?>
                            <li class="page-item"><a class="page-link"
                                    href="/thesis/contents/events/all?page=<?php echo $i; ?>&sort=<?php echo $_GET["sort"]; ?>">
                                    <?php echo $i ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="/thesis/contents/events/all?page=<?php echo $i; ?>">
                                    <?php echo $i ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($page < ceil(count($events) / 3)) { ?>
                        <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["sort"])) {
                            echo "/thesis/contents/events/all?page=" . ($page + 1) . "&sort=" . $_GET["sort"];
                        } else {
                            echo "/thesis/contents/events/all?page=" . $page + 1;
                        } ?>>
                                Next</a></li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
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
                        <img style="height: 10rem; width: auto; object-fit: cover;"
                            src="/thesis/public/images/cover/<?php echo $event[4]; ?>" class="card-img-top">
                        <div class="card-body" style="height: 240px">
                            <h5 class="card-title"><?php echo $event[0]; ?></h5>
                            <div>
                                <?php if ($event[6] != "") { ?>
                                    <p class="fw-light" style="font-size:14px"><?php echo $stringUtil->truncate($event[6]); ?></p>
                                <?php } ?>
                                <div style="font-size: 14px;" class="bg-success bg-opacity-75 text-white p-1 rounded">
                                    <p class="m-0 fw-semibold">Starts on</p>
                                    <p class="m-0"><?php echo $stringUtil->dateAndTime($event[2]); ?></p>
                                </div>
                                <?php if (!($event[4] == "0000-00-00 00:00:00")) { ?>
                                    <div style="font-size: 14px;" class="bg-danger bg-opacity-75 text-white p-1 rounded mt-1">
                                        <p class="m-0">Ends on</p>
                                        <p class="m-0"><?php echo $stringUtil->dateAndTime($event[3]); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer"><a href="/thesis/contents/events?id=<?php echo $event[5]; ?>"
                                class="btn btn-sm btn-dark">Details</a></div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
<?php } ?>

<?php
include "script.php";
include "/xampp/htdocs/thesis/views/contents/layout/footer.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>