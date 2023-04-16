<?php
require "includes/init.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

$email = '';
$subject = '';
$message = '';
$sent = false;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = "Please enter a valid email address";
    };

    if ($subject == '') {
        $errors[] = "Please enter a subject";
    }

    if (trim($message) == '') {
        $errors[] = "Please enter a message";
    }

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                      //Send using SMTP
            $mail->Host       = SMTP_HOST;                        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                             //Enable SMTP authentication
            $mail->Username   = SMTP_USER;                        //SMTP username
            $mail->Password   = SMTP_PASSWORD;                    //SMTP password
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
            $mail->Port       = 2525;                             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom($email, 'Mailer');
            $mail->addAddress('matuko305@gmail.com', 'PHP-CMS'); //Add a recipient
            $mail->addReplyTo($email, 'Information');
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            $sent = true;
        } catch (Exception $e) {
            $errors[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container w-50 mt-5">

    <?php if ($sent) : ?>
        <p>Message has been sent</p>
    <?php else : ?>

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li> <?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>



        <h1 class="display-6 mb-4">Contact</h1>
        <form method="post" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?= htmlspecialchars($subject) ?>">
            </div>
            <div class="mb-3">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows=4><?= htmlspecialchars(trim($message)) ?>
        </textarea>
            </div>
            <button type="submit" class="btn btn-dark w-100 mt-3 font-monospace fw-bold">Send</button>
        </form>
</div>
<?php endif; ?>

<?php require "includes/footer.php"; ?>