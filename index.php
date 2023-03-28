<?php require 'includes/database.php'; ?>
<?php $conn = db_connent(); ?>

<?php

$sql = "SELECT * 
        FROM article 
        ORDER BY published_at";

$resluts = mysqli_query($conn, $sql);

if ($resluts === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($resluts, MYSQLI_ASSOC);
}

?>

<?php require 'includes/header.php'; ?>


<h1 class="display-3 mb-5">My blog</h1>
<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>
    <ul class="list-group list-group-flush">
        <?php foreach ($articles as $article) : ?>
            <li class="list-group-item">
                <article>
                    <a href="article.php?id=<?= $article['id']; ?>">
                        <h2 class="display-6"><?= htmlspecialchars($article['title']); ?></h2>
                    </a>
                    <p><?= htmlspecialchars($article['content']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>