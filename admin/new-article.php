<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $db = new Database();
    $conn = $db->getConn();

    // get form values
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];


    if ($article->create($conn)) {
        header("Location: article.php?id={$article->id}");
    }
}
?>


<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">New article</h1>
    <?php require 'includes/article-form.php'; ?>
</div>

<?php require '../includes/footer.php'; ?>