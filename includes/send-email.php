<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/vendor/PHPMailer/src/Exception.php';
require '/vendor/PHPMailer/src/PHPMailer.php';
require '/vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                  //Send using SMTP
    $mail->Host       = 'smtp.example.com';           //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                         //Enable SMTP authentication
    $mail->Username   = 'user@example.com';           //SMTP username
    $mail->Password   = 'secret';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Enable implicit TLS encryption
    $mail->Port       = 587;                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('matuko305@gmail.com', 'Joe User'); //Add a recipient
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
