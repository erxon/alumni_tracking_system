<?php

include("/xampp/htdocs/thesis/models/Alumni.php");
include("/xampp/htdocs/thesis/models/Email.php");

$id = $_GET["id"];
$alumni = new Alumni();
$email = new Email();
$alumniDetails = $alumni->getAlumniById($id);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo json_encode($alumniDetails);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["status"])) {
        $status = $_POST['status'];
        // echo $status;
        $result = $alumni->setStatus($status, $id);
        // echo $result;

        $title = "Alumni Approval";
        $body = "Contratulations, you are now registered in LYFJSHS - Alumni Tracking System";
        $subject = "Account approval";
        $recipientName = $alumniDetails["firstName"] . " " . $alumniDetails["lastName"];
        $recipientEmail = $alumniDetails["email"];

        $email->sendCustomEmail(
            $title, 
            $body,
            $subject,
            $recipientName, 
            $recipientEmail
        );

        echo json_encode(array("result" => $result));
    }

    if (isset($_POST["delete"])) {
        // echo $userAccountID;
        $result = $alumni->deleteAlumni($id, $alumniDetails["userAccountID"]);

        $title = "Registration Declined";
        $body = "We're sorry, your details was not found on our alumni database.";
        $subject = "Registration Declined";
        $recipientName = $alumniDetails["firstName"] . " " . $alumniDetails["lastName"];
        $recipientEmail = $alumniDetails["email"];

        $email->sendCustomEmail(
            $title, 
            $body,
            $subject,
            $recipientName, 
            $recipientEmail
        );

        echo json_encode(array("result" => $result));
    }
}
