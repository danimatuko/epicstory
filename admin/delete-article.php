<?php

require '../includes/init.php';

Auth::requireLogin();

$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        exit("article not found");
    }
} else {
    exit("id not supplied,aricle not found");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($article->delete($conn)) {
        unlink("../uploads/$article->image_path");
        header("Location: index.php");
    }
}
