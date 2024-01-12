<?php
session_start();

if (!isset($_SESSION["type"]) || $_SESSION["type"] != "admin") {
    header("Location: /thesis/");
    return;
}

include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div class="container w-75 m-auto bg-white p-3">
        <h3 class="mb-3">Add Survey</h3>
        <form id="surveys-form" class="surveys-form">
            <div class="row mb-3">
                <div class="col-lg-8">
                    <!-----Survey Body----->
                    <input name="coverImage" type="file" class="form-control mb-2" />
                    <input name="question" type="text" class="form-control mb-2" placeholder="Question" />
                    <textarea name="body" id="content-body" class="form-control"></textarea>
                </div>
                <div class="col-lg-4">
                    <!-----Survey Answers----->
                    <div class="d-flex mb-3">
                        <input id="surveys-answer" name="answer" class="form-control me-2" placeholder="Choices" />
                        <button type="button" id="surveys-add-answer" class="btn btn-sm btn-light"><i class="fas fa-plus"></i></button>
                    </div>
                    <div id="answers-container"></div>
                </div>
            </div>
            <button class="btn btn-sm btn-dark" type="submit">Save</button>
            <a role="button" href="/thesis/contents/surveys/all" class="btn btn-sm btn-secondary">Discard</a>
        </form>
    </div>
</div>

<?php
include("/xampp/htdocs/thesis/views/template/footer.php");
?>