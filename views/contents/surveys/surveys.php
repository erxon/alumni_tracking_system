<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$surveys = $content->getSurveys();
$stringUtil = new StringUltilities();

$numberOfItemsPerPage = 4;
$page = $_GET["page"];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["sort"])) {
        $surveys = $content->getSortedSurveys($_GET["sort"]);
    }
    if (isset($_GET["title"])) {
        $surveys = $content->getSurveyByTitle($_GET["title"]);
    }
}

?>

<?php
include "/xampp/htdocs/thesis/views/template/header.php";
include "/xampp/htdocs/thesis/views/contents/layout/header.php";
?>
<div class="mt-4 py-3">
    <a role="button" class="btn btn-sm btn-dark mb-2 action-link" href="/thesis/contents/surveys">
        <i class="fas fa-question me-2"></i>Survey
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
                <input id="title" placeholder="Survey title" class="form-control me-2" name="title" value="" />
                <button disabled id="search-by-name" class="btn btn-sm btn-dark">Search</button>
            </div>
        </form>
        <button id="reload-page" class="btn btn-sm btn-dark action">Reset</button>
    </div>
    <table style="font-size: 14px;" class="table table-striped">
        <thead>
            <th>No.</th>
            <th>Title</th>
            <th>Date created</th>
            <th>Actions</th>
        </thead>
        <tbody id="surveys-container">
            <?php
            $number = 1;
            for ($i = ($page - 1) * $numberOfItemsPerPage; $i < ($page * $numberOfItemsPerPage) && $i < count($surveys); $i++) { ?>
                <tr>
                    <input hidden id="cover-image-<?php echo $surveys[$i][0]; ?>" value="<?php echo $surveys[$i][5] ?>" />
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo $surveys[$i][1]; ?></td>
                    <td><?php
                        $dateCreated = $stringUtil->dateAndTime($surveys[$i][4]);
                        echo $dateCreated;
                        ?></td>
                    <td>
                        <a href="/thesis/contents/surveys?id=<?php echo $surveys[$i][0]; ?>" class="btn btn-sm btn-dark action-link">Details</a>
                        <button onclick="alumniInfo('<?php echo $surveys[$i][1] ?>', 
                            '<?php echo $surveys[$i][0] ?>', 
                            '<?php echo '/thesis/contents/surveys?id=' . $surveys[$i][0]; ?>',
                            '<?php echo 'Survey' ?>')" data-bs-toggle="modal" data-bs-target="#send-email" class="btn btn-sm btn-dark">Send email</button>
                        <a role="button" href="/thesis/contents/surveys/edit?id=<?php echo $surveys[$i][0]; ?>" class="btn btn-sm btn-outline-secondary action-link"><i class="far fa-edit"></i></a>
                        <button onclick="deleteSurvey(<?php echo $surveys[$i][0]; ?>)" data-bs-toggle="modal" data-bs-target="#delete-survey-confirm" class="btn btn-sm btn-outline-secondary action"><i class="fas fa-trash"></i></button>

                        <div style="display: none" id="spinner-<?php echo $surveys[$i][0]; ?>" class="spinner-border text-dark spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            <?php
                $number++;
            }
            ?>
        </tbody>
    </table>
    <?php if (count($surveys) > $numberOfItemsPerPage) { ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1) { ?>
                    <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["sort"])) {
                                                                        echo "/thesis/contents/surveys/all?page=" . ($page - 1) . "&sort=" . $_GET["sort"];
                                                                    } else {
                                                                        echo "/thesis/contents/surveys/all?page=" . $page - 1;
                                                                    } ?>>
                            Previous</a></li>
                <?php } ?>
                <?php for ($i = 1; $i < ceil(count($surveys) / $numberOfItemsPerPage) + 1; $i++) { ?>
                    <?php if (isset($_GET["sort"])) { ?>
                        <li class="page-item"><a class="page-link" href="/thesis/contents/surveys/all?page=<?php echo $i; ?>&sort=<?php echo $_GET["sort"]; ?>">
                                <?php echo $i ?></a></li>
                    <?php } else { ?>
                        <li class="page-item"><a class="page-link" href="/thesis/contents/surveys/all?page=<?php echo $i; ?>">
                                <?php echo $i ?></a></li>
                    <?php } ?>
                <?php } ?>
                <?php if ($page < ceil(count($surveys) / $numberOfItemsPerPage)) { ?>
                    <li class="page-item"><a class="page-link" href=<?php if (isset($_GET["filter"])) {
                                                                        echo "/thesis/contents/surveys/all?page=" . ($page + 1) . "&sort=" . $_GET["sort"];
                                                                    } else {
                                                                        echo "/thesis/contents/surveys/all?page=" . $page + 1;
                                                                    } ?>>
                            Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
</div>
<div class="modal fade" id="delete-survey-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete survey</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this survey?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button data-bs-dismiss="modal" id="confirm-survey-delete" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php
include "/xampp/htdocs/thesis/views/contents/send_email/send_email_modal.php";
include "script.php";
include "/xampp/htdocs/thesis/views/contents/send_email/send_email_script.php";
include "/xampp/htdocs/thesis/views/template/footer.php";
?>