<?php

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$id = $_GET["id"];
$content = new Contents();
$survey = $content->getSurvey($id);


include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div class="container w-50 m-auto bg-white rounded shadow p-3 mt-5">
        <div style="font-size: 14px;" class="mb-3 border-bottom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/thesis/contents/surveys/all">Surveys</a></li>
                <li class="breadcrumb-item"><a href="/thesis/contents/surveys?id=<?php echo $id; ?>"><?php echo $survey["title"]; ?></a></li>
                <li class="breadcrumb-item" aria-current="page">Edit</li>
            </ol>
        </div>
        <h3 class="mb-3">Update survey</h3>

        <form enctype="multipart/form-data" id="edit-surveys-form">
            <input hidden name="id" value="<?php echo $id; ?>" />
            <div class="mb-3">
                <!-----Survey Body----->
                <input hidden name="coverImage" value="<?php echo $survey["coverImage"]; ?>" />
                <img class="mb-2" style="width: 100%; height: 300px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey["coverImage"]; ?>" />

                <input name="newCoverImage" type="file" class="form-control mb-2" />
                <input name="title" type="text" class="form-control mb-2" placeholder="Question" value="<?php echo $survey["title"]; ?>" />
                <textarea name="description" id="content-body" class="form-control">
                        <?php echo $survey["description"]; ?>
                    </textarea>
            </div>

            <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#confirm-edit-modal" type="button">Save</button>
            <a role="button" href="/thesis/contents/surveys/all" class="btn btn-sm btn-secondary">Discard</a>

            <div class="modal fade" id="confirm-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Save changes</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to update this survey?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include "script.php";
include("/xampp/htdocs/thesis/views/template/footer.php");
?>