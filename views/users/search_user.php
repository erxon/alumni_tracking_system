<?php

include "/xampp/htdocs/thesis/models/Database.php";

$db = new Database();

$filter = $_POST["search-filter"];
$value = $_POST["search-user"];
$query = "";

if ($filter == "username") {
    $query = "SELECT id, username, firstName, lastName, email, type FROM user WHERE username='$value' ORDER BY dateCreated DESC";
}

if ($filter == "firstName") {
    $query = "SELECT id, username, firstName, lastName, email, type FROM user WHERE firstName='$value' ORDER BY dateCreated DESC";
}

if ($filter == "lastName") {
    $query = "SELECT id, username, firstName, lastName, email, type FROM user WHERE lastName='$value' ORDER BY dateCreated DESC";
}

if ($filter == "type") {
    $query = "SELECT id, username, firstName, lastName, email, type FROM user WHERE type='$value' ORDER BY dateCreated DESC";
}

$result = $db->query($query);

if ($result->num_rows > 0) {
    $result = $result->fetch_all();
    echo json_encode([
        "success" => true,
        "results" => $result
    ]);
} else {
    echo json_encode(["success" => false, "message" => "user not found"]);
}
