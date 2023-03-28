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
    <ul>
        <li>
            <article>
                <h2><?= htmlspecialchars($article['title']); ?></h2>
                <p><?= htmlspecialchars($article['content']); ?></p>
            </article>
        </li>
    </ul>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>