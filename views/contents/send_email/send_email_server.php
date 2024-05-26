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
$alumniAccount = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contentTitle = $_POST["title"];
    $additionalNote = $_POST["additional-note"];
    $contentUrl = $_POST["url"];
    $description = $_POST["description"];
    $contentId = $_POST["id"];
    $target = $_POST["target"];
    $spec_target = $_POST["specific-target"];

    $message = "<div>
        <h1>$contentTitle</h1>
        <a href='$contentUrl'>$contentUrl</a>
        <p>$description</p>
        <p style='color: #8a8a8a'>$additionalNote</p>
    </div>";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = "smtp.sendgrid.net";
    $mail->SMTPAuth = true;
    $mail->Username = "apikey";
    $mail->Password = "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";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->setFrom("ats.es@outlook.ph");

    if ($target == "per-track") {
        $alumniAccounts = $alumni->getAlumniEmailByTrack($spec_target);
    }

    if ($target == "per-batch") {
        $alumniAccounts = $alumni->getAlumniEmailByBatch($spec_target);
    }


    foreach ($alumniAccounts as $account) {
        $firstName = $account[1];
        $lastName = $account[2];
        $name = "$firstName $lastName";
        $email = $account[0];

        $mail->addCC($email, $name);
    }

    $mail->isHTML(true);

    $mail->Subject = "ALUMNI TRACKING SYSTEM CONTENT UPDATE";
    $mail->Body = $message;

    try {
        $mail->send();
        echo json_encode(["response" => "Email sent!", "sent" => true]);
    } catch (Exception $e) {
        echo json_encode(["response" => $e->getMessage(), "sent" => false]);
    }
}
