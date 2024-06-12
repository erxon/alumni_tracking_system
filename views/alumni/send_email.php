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
    $recipient = $_POST["recipient"];
    $perTrackRecipient = $_POST["per-track-recipient"];
    $perBatchRecipient = $_POST["per-batch-recipient"];
    $body = $_POST["alumni_email_content"];
    $subject = $_POST["subject"];

    $message = "<div><p>$body</p></div>";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = "smtp.sendgrid.net";
    $mail->SMTPAuth = true;
    $mail->Username = "apikey";
    $mail->Password = "asdf";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->setFrom("ats.es@outlook.ph");

    if ($recipient == "track") {
        $alumniAccounts = $alumni->getAlumniEmailByTrack($perTrackRecipient);
    }

    if ($recipient == "batch") {
        $alumniAccounts = $alumni->getAlumniEmailByBatch($perBatchRecipient);
    }

    if ($recipient == "individual") {
        $alumniAccount = $_POST["alumni_email"];
    }

    if ($alumniAccount !== "") {
        $mail->addCC($alumniAccount);
    } else {
        foreach ($alumniAccounts as $account) {
            $firstName = $account[1];
            $lastName = $account[2];
            $name = "$firstName $lastName";
            $email = $account[0];

            $mail->addCC($email, $name);
        }
    }
   
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        $mail->send();
        echo json_encode(["response" => "Email sent!", "sent" => true]);
    } catch (Exception $e) {
        echo json_encode(["response" => $e->getMessage(), "sent" => false]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $recipient = $_GET["recipient"];

    $db = new Database();

    $query = "SELECT id, photo, email, firstName, lastName 
    FROM alumni WHERE email LIKE '%$recipient%';";

    $result = $db->query($query);
    $alumniInformation = $result->fetch_all();
    $db->close();

    echo json_encode(["result" => $alumniInformation]);
}
