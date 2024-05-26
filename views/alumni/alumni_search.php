<?php
include("/xampp/htdocs/thesis/models/Alumni.php");

$alumni = new Alumni();

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$track = filter_input(INPUT_POST, "track", FILTER_SANITIZE_SPECIAL_CHARS);
$strand = filter_input(INPUT_POST, "strand", FILTER_SANITIZE_SPECIAL_CHARS);
$batch = filter_input(INPUT_POST, "batch", FILTER_SANITIZE_SPECIAL_CHARS);

// $result = $alumni->searchAlumni($name, $track, $strand, $batch);

echo json_encode($result);
