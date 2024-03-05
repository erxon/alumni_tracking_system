<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/Exception.php";
require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/SMTP.php";

require("/xampp/htdocs/thesis/models/Alumni.php");


$alumni = new Alumni();
$alumniAccounts = $alumni->getAllAlumniEmail();
$recipient = $_POST["recipient"];
$perTrackRecipient = $_POST["per-track-recipient"];
$perBatchRecipient = $_POST["per-batch-recipient"];
$title = $_POST["title"];
$body = $_POST["alumni_email_content"];
$subject = $_POST["subject"];

$message = "<div><h1>$title</h1><p>$body</p></div>";

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp.sendgrid.net";
$mail->SMTPAuth = true;
$mail->Username = "apikey";
$mail->Password = "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";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

$mail->setFrom("ericson.es@outlook.com");

if($recipient == "track"){
    $alumniAccounts = $alumni->getAlumniEmailByTrack($perTrackRecipient);
}

if($recipient == "batch"){
    $alumniAccounts = $alumni->getAlumniEmailByBatch($perBatchRecipient);
}


foreach ($alumniAccounts as $account) {
    $firstName = $account[1];
    $lastName = $account[2];
    $name = "$firstName $lastName";
    $email = $account[0];

    $mail->addCC($email, $name);
}

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $message;

try {
    $mail->send();
    echo json_encode(array("response" => "Email sent!", "sent"=> true));
} catch (Exception $e) {
    echo json_encode(array("response" => $e->getMessage(), "sent"=> false));
}
