<?php require 'includes/database.php'; ?>
<?php $conn = db_connent(); ?>

<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = "SELECT * 
        FROM article 
        WHERE id = " . $_GET['id'];

    $resluts = mysqli_query($conn, $sql);

    if ($resluts === false) {
        echo mysqli_error($conn);
    } else {
        $article = mysqli_fetch_assoc($resluts);
    }
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
            <h2><?= htmlspecialchars ($article['title']); ?></h2>
            <p><?=htmlspecialchars($article['content']); ?></p>
        </article>
    </li>
</ul>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>