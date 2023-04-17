<?php

require 'includes/init.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {
        Auth::login();
        header("Location: index.php");
    } else {
        $error = 'Incorrect login credentials';
    }
}
?>

<?php require 'includes/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col col-md-4 mx-auto">
            <h1 class="display-3 mb-5">Login</h1>

            <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
            <?php endif ?>

            <form method="post" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="name" name="username" ">
    </div>
    <div class=" mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>