<?php

require "../includes/init.php";


$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require '../includes/header.php'; ?>


<div class="w-75 m-auto">

    <a href="index.php">Back</a>

    <?php if (($article)) : ?>
    <article class="py-3">
        <time datetime="<?= $article[0]['published_at'] ?>">
            <?php
                $datetime = new DateTime($article[0]['published_at']);
                echo  $article[0]['published_at'] ? $datetime->format("j F Y") : "Not published";
                ?>
        </time>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-3"><?= htmlspecialchars($article[0]['title']); ?></h1>
            <!-- Categories -->
            <?php if ($article[0]['category_name']) : ?>
            <div>
                <strong>Categories:</strong>
                <?php foreach ($article as $a) : ?>
                <?= htmlspecialchars($a['category_name']) ?>
                <?php endforeach; ?>
            </div>
            <?php endif ?>
            <div>
                <a href="edit-article.php?id=<?= $article[0]['id']; ?>" class="btn btn-sm btn-outline-info">Edit</a>
                <button data-bs-toggle="modal" data-bs-target="#myModal"
                    class="btn btn-sm btn-outline-danger">Delete</button>
                <a href="edit-article-image.php?id=<?= $article[0]['id'] ?>" class="btn btn-sm btn-outline-dark">Edit
                    image</a>
            </div>
        </div>


        <?php if ($article[0]['image_path']) : ?>
        <img src="/uploads/<?= htmlspecialchars($article[0]['image_path']); ?>" class="img-fluid mb-3" alt="">
        <?php endif ?>

        <p class="fs-5"><?= htmlspecialchars($article[0]['content']); ?></p>
    </article>

    <?php else : ?>
    <p>No article found.</p>
    <?php endif; ?>
</div>




<?php include "includes/delete-modal.php"; ?>


<?php require '../includes/footer.php'; ?>