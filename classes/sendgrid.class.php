<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// composer require phpmailer <- run on server ->
//require '../vendor/autoload.php'; 
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

class sendgrid
{
    public static function send($to, $subject, $message, $from)
    {
        $from = 'ritma-loyalty-autoreply@ritmapres.com';
        //Replace smtp_username with your mailchimp smtp user name.
        $usernameSmtp = 'Ritma Loyalty System'; // please adjust
        $passwordSmtp = 'QbeTrJRRdDboKBYfR9t3vQ'; // please adjust
 
        $host = 'smtp.mandrillapp.com';
        $port = 587;

        $mail = new PHPMailer(true);

        try {
            // Specify the SMTP settings.
            $mail->isSMTP();
            $mail->setFrom($from, 'Ritma Loyalty System'); // please adjust
            $mail->Username = $usernameSmtp;
            $mail->Password = $passwordSmtp;
            $mail->Host = $host;
            $mail->CharSet = 'UTF-8';

            $mail->Port = $port;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->ClearAddresses();
            $mail->ClearCCs();
            $mail->ClearBCCs();
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);
            $mail->Send();

            $response = 'Sent';
        } catch (phpmailerException $e) {
            $response = $e->errorMessage();
        } catch (Exception $e) {
            $response = $mail->ErrorInfo;
        }

            echo $reponse; // remove after testing
    }
}