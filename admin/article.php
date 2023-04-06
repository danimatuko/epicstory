<?php

require "../includes/init.php";


$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require '../includes/header.php'; ?>



<div class="w-75 m-auto">

    <a href="index.php">Back</a>

    <?php if (($article)) : ?>
        <article class="py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-3"><?= htmlspecialchars($article->title); ?></h1>
                <div>
                    <a href="edit-article.php?id=<?= $article->id; ?>" class="btn btn-sm btn-outline-info">Edit</a>
                    <a href="delete-article.php?id=<?= $article->id; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                    <a href="edit-article-image.php?id=<?= $article->id; ?>" class="btn btn-sm btn-outline-dark">Edit
                        image</a>
                </div>
            </div>
            <?php if ($article->image_path) : ?>
                <img src="/uploads/<?= htmlspecialchars($article->image_path); ?>" class="img-fluid mb-3" alt="">
            <?php endif ?>
            <p class="fs-5"><?= htmlspecialchars($article->content); ?></p>
        </article>

    <?php else : ?>
        <p>No article found.</p>
    <?php endif; ?>
</div>


<?php require '../includes/footer.php'; ?>