<?php

require "../includes/init.php";


if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>

<?php

function isMobileDevice() {
    return preg_match(
        "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        $_SERVER["HTTP_USER_AGENT"]
    );
}
?>

<?php require '../includes/header.php'; ?>


<div class="container">
    <div class="row">
        <div class="col col-md-8 mx-auto">
            <div class="d-flex justify-content-between">
                <a href="index.php">Back</a>
                <!-- Edit Aticle | Mobile -->
                <?php if (isMobileDevice()) : ?>
                    <div>
                        <a href="edit-article.php?id=<?= $article[0]['id']; ?>" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="edit-article-image.php?id=<?= $article[0]['id'] ?>" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-images"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                    </div>
                <?php else : ?>
                    <!-- Edit Aticle | Desktop -->
                    <div>
                        <a href="edit-article.php?id=<?= $article[0]['id']; ?>" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</a>
                        <a href="edit-article-image.php?id=<?= $article[0]['id'] ?>" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-images  me-1"></i>Edit Image</a>
                        <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash  me-1"></i>Delete</button>
                    </div>
                <?php endif; ?>

            </div>

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
                    </div>
                    <!-- Categories -->
                    <div class="d-block">
                        <?php if ($article[0]['category_name']) : ?>
                            <div>
                                <strong>Categories:</strong>
                                <?php foreach ($article as $a) : ?>
                                    <?= htmlspecialchars($a['category_name']) ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif ?>
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
    </div>
</div>




<?php include "includes/delete-modal.php"; ?>


<?php require '../includes/footer.php'; ?>