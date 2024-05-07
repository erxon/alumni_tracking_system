<?php

include "/xampp/htdocs/thesis/models/Alumni.php";

$alumni = new Alumni();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "delete-alumni") {
        $id = $_POST["id"];
        $alumniAccount = $alumni->getAlumniById($id);

        $result = $alumni->deleteAlumni($id, $alumniAccount["userAccountID"]);

        echo json_encode(["response" => $result]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $getAlumni = $alumni->getAllAlumni();
    echo json_encode(["response" => $getAlumni]);
}
