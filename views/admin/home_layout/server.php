<?php

include "/xampp/htdocs/thesis/models/Contents.php";

$contents = new Contents();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    $result = $contents->getContent($id);

    echo json_encode(["response"=>true, "result" =>$result]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eventHighlight = $_POST["eventHighlight"];
    $newsHighlight = $_POST["newsHighlight"];

    $result = $contents->setHomePageLayout($eventHighlight, $newsHighlight);

    echo json_encode(["response"=>$result]);
}
