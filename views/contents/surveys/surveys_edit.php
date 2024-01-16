<?php

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$id = $_GET["id"];
$content = new Contents();
$survey = $content->getSurveyQuestion($id);
$answers = $content->getSurveyAnswers($id);


include("/xampp/htdocs/thesis/views/template/header.php");
?>

<div class="main-body-padding">
    <div style="border-radius: 10px;" class="container w-75 m-auto bg-white p-3">
        <h3 class="mb-3">Edit Survey</h3>
        <form id="edit-surveys-form">
            <input hidden name="id" value="<?php echo $id; ?>" />
            <div class="row mb-3">
                <div class="col-lg-8">
                    <!-----Survey Body----->
                    <input hidden name="coverImage" value="<?php echo $survey["coverImage"]; ?>" />
                    <img class="mb-2" style="width: 100%; height: 300px; object-fit: cover;" src="/thesis/public/images/cover/<?php echo $survey["coverImage"]; ?>" />
                    
                    <input name="coverImageFile" type="file" class="form-control mb-2" />
                    <input name="question" type="text" class="form-control mb-2" placeholder="Question" value="<?php echo $survey["question"]; ?>" />
                    <textarea name="body" id="content-body" class="form-control">
                        <?php echo $survey["body"]; ?>
                    </textarea>
                </div>
                <div class="col-lg-4">
                    <!-----Survey Answers----->
                    <div class="d-flex mb-3">
                        <input id="edit-surveys-answer" name="answer" class="form-control me-2" placeholder="Choices" />
                        <button type="button" id="edit-surveys-add-answer" class="btn btn-sm btn-light"><i class="fas fa-plus"></i></button>
                    </div>
                    <ol id="edit-answers-container">
                        <?php for ($i = 0; $i < count($answers); $i++) { ?>
                            <div class="answer">
                                <li id="answer<?php echo $i + 1; ?>"><?php echo $answers[$i][2]; ?></li>
                                <button onclick="deleteSurveyAnswer(<?php echo $i ?>)" class="remove-answer btn btn-sm btn-light">remove</button>
                            </div>
                        <?php } ?>
                    </ol>
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