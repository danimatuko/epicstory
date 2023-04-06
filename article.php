<?php

require "includes/init.php";


$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'; ?>

<div class="w-75 m-auto">

    <a href="index.php">Back</a>

    <?php if (($article)) : ?>
        <article class="py-3">
            <h1 class="mb-3"><?= htmlspecialchars($article->title); ?></h1>
            <?php if ($article->image_path) : ?>
                <img src="/uploads/<?= htmlspecialchars($article->image_path); ?>" class="img-fluid mb-3" alt="">
            <?php endif ?>
            <p class="fs-5"><?= htmlspecialchars($article->content); ?></p>
        </article>
    <?php else : ?>
        <p>No article found.</p>
    <?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>