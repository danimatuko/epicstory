<?php

require "init.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>PHP - CMS</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">

        <a class="navbar-brand bg-dark px-3 text-light fw-bold" href="index.php">CMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="container">
                <ul class="navbar-nav">

                    <?php if (Auth::isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="new-article.php">Post</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item ">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>

                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container py-5">