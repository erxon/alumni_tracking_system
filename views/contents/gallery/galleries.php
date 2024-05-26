<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /thesis/");
    return;
}


include("/xampp/htdocs/thesis/models/Gallery.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$gallery = new Gallery();
$allGallery = $gallery->allGallery();
$stringUtil = new StringUltilities();

$page = "";
$numberOfItemsPerPage = 4;

if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["sort"])) {
        $allGallery = $gallery->getSortedGallery($_GET["sort"]);
    }
    if (isset($_GET["name"])) {
        $allGallery = $gallery->getGalleryByName($_GET["name"]);
    }
}
?>
<?php
include("/xampp/htdocs/thesis/views/template/header.php");
?>
<?php
if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin") { ?>
    <?php include "/xampp/htdocs/thesis/views/contents/layout/header.php" ?>
    <div class="mt-4 py-3">
        <a role="button" class="btn btn-sm btn-dark mb-2" href="/thesis/contents/gallery">
            <i class="far fa-images me-2"></i>Gallery
        </a>
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
                    <input id="title" placeholder="Gallery name" class="form-control me-2" name="name" value="" />
                    <button disabled id="search-by-name" class="btn btn-sm btn-dark">Search</button>
                </div>
            </form>
            <button id="reload-page" class="btn btn-sm btn-dark">Reset</button>
        </div>
        <table style="font-size: 14px;" class="table table-striped">
            <thead>
                <th>No.</th>
                <th>Name</th>
                <th>Date created</th>
                <th>Description</th>
                <th>Actions</th>
            </thead>
            <tbody id="galleries-container">
                <?php
                $number = 1;
                for ($i = ($page - 1) * $numberOfItemsPerPage; $i < ($page * $numberOfItemsPerPage) && $i < count($allGallery); $i++) { ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $allGallery[$i][1] ?></td>
                        <td><?php echo $stringUtil->dateAndTime($allGallery[$i][3]) ?></td>
                        <td><?php echo $stringUtil->truncate($allGallery[$i][2], 50); ?></td>
                        <td>
                            <a role="button" href="/thesis/contents/gallery?id=<?php echo $allGallery[$i][0]; ?>" class="btn btn-sm btn-dark action-link">See images</a>
                            <button onclick="alumniInfo('<?php echo $allGallery[$i][1] ?>', 
                            '<?php echo $allGallery[$i][0] ?>', 
                            '<?php echo '/thesis/contents/gallery?id=' . $allGallery[$i][0]; ?>',
                            '<?php echo $allGallery[$i][2] ?>')" data-bs-toggle="modal" data-bs-target="#send-email" class="btn btn-sm btn-dark">Send email</button>
                            <a role="button" href="/thesis/contents/gallery/edit?id=<?php echo $allGallery[$i][0]; ?>" class="btn btn-sm btn-outline-secondary me-1 action-link"><i class="fas fa-edit"></i></a>
                            <button onclick="deleteGallery('<?php echo $allGallery[$i][0]; ?>')" data-bs-toggle="modal" data-bs-target="#delete-gallery-confirmation" class="btn btn-sm btn-outline-secondary action"><i class="fas fa-trash"></i></button>

                            <div style="display: none" id="spinner-<?php echo $allGallery[$i][0]; ?>" class="spinner-border text-dark spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                <?php
                    $number++;
                } ?>
            </tbody>
        </table>
        <?php if (count($allGallery) > $numberOfItemsPerPage) { ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1) { ?>
                        <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["sort"])) {
                                                                            echo "/thesis/contents/gallery/all?page=" . ($page - 1) . "&sort=" . $_GET["sort"];
                                                                        } else {
                                                                            echo "/thesis/contents/gallery/all?page=" . $page - 1;
                                                                        } ?>>
                                Previous</a></li>
                    <?php } ?>
                    <?php for ($i = 1; $i < ceil(count($allGallery) / $numberOfItemsPerPage) + 1 && $i < 4; $i++) { ?>
                        <?php if (isset($_GET["sort"])) { ?>
                            <li class="page-item"><a class="page-link" href="/thesis/contents/gallery/all?page=<?php echo $i; ?>&sort=<?php echo $_GET["sort"]; ?>">
                                    <?php echo $i ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="/thesis/contents/gallery/all?page=<?php echo $i; ?>">
                                    <?php echo $i ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($page < ceil(count($allGallery) / $numberOfItemsPerPage)) { ?>
                        <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["sort"])) {
                                                                            echo "/thesis/contents/gallery/all?page=" . ($page + 1) . "&sort=" . $_GET["sort"];
                                                                        } else {
                                                                            echo "/thesis/contents/gallery/all?page=" . $page + 1;
                                                                        } ?>>
                                Next</a></li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="main-body-padding surveys" style="margin-top: 5%">
        <h1 class="mb-3">Gallery</h1>
        <div class="row mt-4">
            <?php foreach ($allGallery as $galleryItem) { ?>
                <div class="col-sm-6 col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body d-flex flex-column" style="height: 200px">
                            <div class="h-100">
                                <h5 class="card-title"><i class="far fa-folder"></i> <?php echo $galleryItem[1] ?></h5>
                                <p style="font-size: 14px;"><i class="far fa-clock"></i> <?php echo $stringUtil->dateAndTime($galleryItem[3]) ?></p>
                                <p style="font-size: 14px;"><?php echo $galleryItem[2] ?></p>
                            </div>
                            <a href="/thesis/contents/gallery?id=<?php echo $galleryItem[0]; ?>" class="btn btn-sm btn-dark d-block">Open Gallery</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
<?php } ?>

<div class="modal fade" id="delete-gallery-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete gallery</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this gallery?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="confirm-delete" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php
include "/xampp/htdocs/thesis/views/contents/send_email/send_email_modal.php";
include "script.php";
include "/xampp/htdocs/thesis/views/contents/send_email/send_email_script.php";
include "/xampp/htdocs/thesis/views/contents/layout/footer.php";
include("/xampp/htdocs/thesis/views/template/footer.php")
?>