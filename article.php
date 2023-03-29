<?php require 'includes/database.php'; ?>
<?php require 'includes/article.php'; ?>


<?php

$conn = db_connent();

if (isset($_GET['id'])) {
    $article = get_article($conn, $_GET['id']);
} else {
    $article = null;
}

?>


<?php require 'includes/header.php'; ?>

<h1 class="display-3 mb-5">My blog</h1>
<?php if (($article === null)) : ?>
<p>No article found.</p>
<?php else : ?>
<article>
    <h1><?= htmlspecialchars($article['title']); ?></h1>
    <p><?= htmlspecialchars($article['content']); ?></p>
</article>
<a href="edit-article.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-outline-info">Edit</a>
<form action="delete-article.php?id=<?= $article['id']; ?>" method="post">
    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
</form>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>