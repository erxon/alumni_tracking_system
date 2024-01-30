<?php

require '/xampp/htdocs/thesis/vendor/autoload.php';
class Email
{
    public function sendEmail($emailAddress, $name, $content)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("ericson.es@outlook.com", "ATS - Administrator");
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

        $sendgrid = new \SendGrid("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");

        try {
            $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
