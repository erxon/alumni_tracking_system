<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/Exception.php";
require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/SMTP.php";

require("/xampp/htdocs/thesis/models/Alumni.php");


$alumni = new Alumni();
$alumniAccounts = $alumni->getAllAlumni();

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

foreach ($alumniAccounts as $account) {
    $name = $account[1] . " " . $account[3];
    $email = $account[6];

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
