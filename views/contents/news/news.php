<?php
session_start();

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$news = $content->getNews();
$stringUtil = new StringUltilities();

$page = "";
$numberOfItemsPerPage = 4;

if (isset($_GET["page"])){
    $page = $_GET["page"];
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["sort"])) {
        $news = $content->getSortedNews($_GET["sort"]);
    }
    if (isset($_GET["title"])) {
        $news = $content->getNewsByTitle($_GET["title"]);
    }
}
?>

<?php
include "/xampp/htdocs/thesis/views/template/header.php";

?>
<?php if ($_SESSION["type"] == "admin") { ?>
    <?php include "/xampp/htdocs/thesis/views/contents/layout/header.php" ?>
    <div class="mt-4 py-3">
        <a role="button" class="btn btn-sm btn-dark mb-2" href="/thesis/contents/news"><i class="far fa-newspaper me-2"></i>News</a>
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
                    <input id="title" placeholder="News title" class="form-control me-2" name="title" value="" />
                    <button disabled id="search-by-name" class="btn btn-sm btn-dark">Search</button>
                </div>
            </form>
            <button id="reload-page" class="btn btn-sm btn-dark">Reset</button>
        </div>
        <table style="font-size: 14px;" class="table table-striped">
            <thead>
                <th>No.</th>
                <th>Title</th>
                <th>Date created</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php
                for ($i = ($page - 1) * $numberOfItemsPerPage; $i < ($page * $numberOfItemsPerPage) && $i < count($news); $i++) {
                ?><tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $news[$i][0]; ?></td>
                        <td><?php
                            $dateCreated = $stringUtil->dateAndTime($news[$i][5]);
                            echo $dateCreated;
                            ?></td>
                        <td>
                            <a href="/thesis/contents/news?id=<?php echo $news[$i][3]; ?>" class="btn btn-sm btn-dark">Details</a>
                        </td>
                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
        <?php if (count($news) > $numberOfItemsPerPage) { ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1) { ?>
                        <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["sort"])) {
                                                                            echo "/thesis/contents/news/all?page=" . ($page - 1) . "&sort=" . $_GET["sort"];
                                                                        } else {
                                                                            echo "/thesis/contents/news/all?page=" . $page - 1;
                                                                        } ?>>
                                Previous</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i < ceil(count($news) / $numberOfItemsPerPage) + 1; $i++) { ?>
                        <?php if (isset($_GET["filter"])) { ?>
                            <li class="page-item"><a class="page-link" href="/thesis/contents/news/all?page=<?php echo $i; ?>&sort=<?php echo $_GET["sort"]; ?>">
                                    <?php echo $i ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="/thesis/contents/news/all?page=<?php echo $i; ?>">
                                    <?php echo $i ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($page < ceil(count($news) / $numberOfItemsPerPage)) { ?>
                        <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["filter"])) {
                                                                            echo "/thesis/contents/news/all?page=" . ($page + 1) . "&sort=" . $_GET["sort"];
                                                                        } else {
                                                                            echo "/thesis/contents/news/all?page=" . $page + 1;
                                                                        } ?>>
                                Next</a></li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="main-body-padding surveys" style="margin-top: 5%">
        <h1 class="mb-3">News</h1>
        <div class="row g-1">
            <?php
            foreach ($news as $item) {
            ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card p-0">
                        <img style="height: 10rem; width: auto; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $item[2]; ?>" class="card-img-top">
                        <div class="card-body" style="height: 180px">
                            <h5 class="card-title"><?php echo $item[0]; ?></h5>
                            <div>
                                <p style="font-size: 14px" class="card-subtitle mb-3"><?php
                                                                                        $dateCreated = $stringUtil->dateAndTime($item[4]);
                                                                                        echo $dateCreated;
                                                                                        ?></p>
                                <p class="fw-light"><?php echo $stringUtil->truncate($item[5], 70); ?></p>
                            </div>
                        </div>
                        <div class="card-footer"><a href="/thesis/contents/news?id=<?php echo $item[3]; ?>" class="btn btn-sm btn-dark">Read</a></div>
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