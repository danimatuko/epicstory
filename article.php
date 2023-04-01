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

<a href="index.php">Back</a>

<?php if (($article)) : ?>
    <article class="py-3">
        <h1><?= htmlspecialchars($article->title); ?></h1>
        <p><?= htmlspecialchars($article->content); ?></p>
    </article>
<?php else : ?>
    <p>No article found.</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>