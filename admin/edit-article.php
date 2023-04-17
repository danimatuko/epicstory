<?php

require '../includes/init.php';

Auth::requireLogin();


if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);
    $category_ids = array_column($article->getCategories($conn), 'id');
    $categories = Category::getAll($conn);

    if (!$article) {
        exit("aricle not found");
    }
} else {
    exit("id not supplied,aricle not found");
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form values
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    $category_ids = $_POST['category'] ?? [];



    if ($article->update($conn)) {
        $article->resetCategories($conn);
        $article->setCategories($conn, $category_ids);
        header("Location: article.php?id={$article->id}");
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col col-md-8 mx-auto">
            <h1 class="display-3 mb-5">Edit article</h1>
            <?php require 'includes/article-form.php'; ?>
        </div>
    </div>
</div>

<?php require '../includes/footer.php'; ?>