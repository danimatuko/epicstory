<?php
require "includes/init.php";

$email = '';
$subject = '';
$message = '';

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
        // send email
    }
}

?>

<?php require "includes/header.php"; ?>
<div class="container w-50 mt-5">
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
            <textarea class="form-control" id="message" name="message" rows=4><?= htmlspecialchars($message) ?>
        </textarea>
        </div>
        <button type="submit" class="btn btn-dark w-100 mt-3 font-monospace fw-bold">Send</button>
    </form>
</div>

<?php require "includes/footer.php"; ?>