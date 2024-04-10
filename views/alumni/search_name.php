<?php
require("/xampp/htdocs/thesis/models/Alumni.php");

$query = $_GET["name"];
$alumni = new Alumni();

$result = $alumni->searchName($query);

echo json_encode($result->fetch_all());
