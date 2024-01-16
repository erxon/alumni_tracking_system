<?php
$id = $_GET["id"];

include("/xampp/htdocs/thesis/models/Contents.php");
include("/xampp/htdocs/thesis/models/utilities/StringUtilities.php");

$content = new Contents();
$stringUtil = new StringUltilities();

$survey = $content->getSurveyQuestion($id);
$author = $content->getAuthor($survey["author"]);
$dateCreated = $stringUtil->dateAndTime($survey["dateCreated"]);


if ($survey) {
    echo json_encode(array(
        "coverImage" => $survey["coverImage"],
        "question" => $survey["question"],
        "author" => $author["firstName"]." ".$author["lastName"],
        "dateCreated" => $dateCreated
    ));
} else {
    echo json_encode(array("error" => "Something went wrong."));
}
