<?php

require "includes/init.php";

$db = new Database(HOST, DB, USERNAME, PASSWORD);

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id'], true);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col col-md-8 mx-auto">

            <a href="index.php">Back</a>
            <?php if (($article)) : ?>
                <article class="py-3">
                    <time datetime="<?= $article[0]['published_at']; ?>">
                        <?php
                        $datetime = new DateTime($article[0]['published_at']);
                        echo $datetime->format("j F Y");
                        ?>
                    </time>
                    <h1 class="mb-3 d-block"><?= htmlspecialchars($article[0]['title']); ?></h1>
                    <!-- Categories -->
                    <div class="d-block">
                        <?php if ($article[0]['category_name']) : ?>
                            <div>
                                <strong>Categories:</strong>
                                <?php foreach ($article as $a) : ?>
                                    <div class="badge bg-secondary text-capitalize">
                                        <?= htmlspecialchars($a['category_name']) ?>
                                    </div> <?php endforeach; ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <?php if ($article[0]['image_path']) : ?>
                        <img src="/uploads/<?= htmlspecialchars($article[0]['image_path']); ?>" class="img-fluid mb-3" alt="">
                    <?php endif ?>

                    <p class="fs-5 py-5"><?= htmlspecialchars($article[0]['content']); ?></p>
                </article>

            <?php else : ?>
                <p>No article found.</p>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php require 'includes/footer.php'; ?>