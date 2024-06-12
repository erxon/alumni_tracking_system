<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/Exception.php";
require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/xampp/htdocs/thesis/vendor/phpmailer/phpmailer/src/SMTP.php";
class Email
{
    public function sendEmail($emailAddress, $name, $content)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("ats.es@outlook.ph", "ATS - Administrator");
        $email->setSubject("Your account has been deleted");
        $email->addTo($emailAddress, $name);
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",
            "
            <h1>Hello $name,</h1>
            <p>$content</p>
            "
        );

        $sendgrid = new \SendGrid("asdf");

        try {
            $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    public function sendCustomEmail($title, $body, $subject, $recipientName, $recipientEmail)
    {
        $message = "<div><h1>$title</h1><p>$body</p></div>";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = "smtp.sendgrid.net";
        $mail->SMTPAuth = true;
        $mail->Username = "apikey";
        $mail->Password = "asdf";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom("ats.es@outlook.ph");
        $mail->addCC($recipientEmail, $recipientName);
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    }
}
