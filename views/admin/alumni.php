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

        $recipientName = $alumniDetails["firstName"] . " " . $alumniDetails["lastName"];
        $recipientEmail = $alumniDetails["email"];

        $title = "Alumni Approval";
        $body = "
        <p>Dear Mr. or Mrs. $recipientName,<p>

        <p>We have received your application within the Luis Y. Ferrer Jr.
        Senior High School Alumni Tracking System. It is with pleasure
        that we notify you of the approval of your registration.</p>

        <p>To access your account, you may use your registered email
        address.</p>

        <p>If you require any further information or assistance, please do not
        hesitate to contact us. Thank you.</p>

        <p>Sincerely,</p>

        <p>Luis Y. Ferrer Senior High School ICT</p>
        ";
        $subject = "Luis Y. Ferrer Jr. Senior High School Alumni Tracking System Application Notice";


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

        $recipientName = $alumniDetails["firstName"] . " " . $alumniDetails["lastName"];
        $recipientEmail = $alumniDetails["email"];

        $title = "Registration Declined";
        $body = "
        <p>Dear Mr./Ms. $recipientName, </p>

        <p>We have received your application within the Luis Y. Ferrer Jr.
        Senior High School Alumni Tracking System. We are sorry to
        inform you that your registration has been rejected due to the 
        reason that we have no records of the details you have provided 
        us.</p>

        <p>If you require any further information or assistance, please do not
        hesitate to contact us. Thank you.</p>

        <p>Sincerely,</p>

        <p>Luis Y. Ferrer Senior High School ICT</p>
        ";
        $subject = "Luis Y. Ferrer Jr. Senior High School Alumni Tracking System Application Notice";


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
