<?php

require '../includes/init.php';

Auth::requireLogin();

$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        exit("aricle not found");
    }
} else {
    exit("id not supplied,aricle not found");
}


echo '<pre>', var_dump($article->getCategories($conn)), '</pre>';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // get form values
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if ($article->update($conn)) {
        header("Location: article.php?id={$article->id}");
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Edit article</h1>
    <?php require 'includes/article-form.php'; ?>
</div>

<?php require '../includes/footer.php'; ?>