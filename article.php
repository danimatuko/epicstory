<?php

require 'includes/database.php';
require 'includes/article.php';




$conn = db_connent();

if (isset($_GET['id'])) {
    $article = get_article($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'; ?>

<a href="index.php">Back</a>

<?php if (($article === null)) : ?>
    <p>No article found.</p>
<?php else : ?>
    <article class="py-3">
        <h1><?= htmlspecialchars($article['title']); ?></h1>
        <p><?= htmlspecialchars($article['content']); ?></p>
    </article>
    <a href="edit-article.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-outline-info">Edit</a>
    <a href="delete-article.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>