<?php

require 'classes/Database.php';
require 'classes/Article.php';

$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'; ?>

<a href="index.php">Back</a>

<?php if (($article)) : ?>
    <article class="py-3">
        <h1><?= htmlspecialchars($article['title']); ?></h1>
        <p><?= htmlspecialchars($article['content']); ?></p>
    </article>
    <a href="edit-article.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-outline-info">Edit</a>
    <a href="delete-article.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
<?php else : ?>
    <p>No article found.</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>