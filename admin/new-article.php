<?php

require '../includes/init.php';

Auth::requireLogin();


$article = new Article();

$categories = Category::getAll($conn);
$category_ids = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form values
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];
    $category_ids = $_POST['category'] ?? [];


    if ($article->create($conn)) {
        $article->setCategories($conn, $category_ids);
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