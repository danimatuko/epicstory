<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"
        defer>
    </script>
    <script src="/js/index.js" defer></script>

    <title>PHP - CMS</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
        <div class="container">
            <a class="navbar-brand bg-dark px-3 text-light fw-bold" href="/">Epic Story</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav" style="flex-grow: unset;">
                <div class="container">
                    <ul class="navbar-nav mx-auto">

                        <?php if (Auth::isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/new-article.php">Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout.php">Logout</a>
                        </li>
                        <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login.php">Login</a>
                        </li>

                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main class="container py-5">