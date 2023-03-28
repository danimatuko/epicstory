<?php require 'includes/database.php'; ?>
<?php require 'includes/article.php'; ?>
<?php require 'includes/header.php'; ?>


<?php

$conn = db_connent();

if (isset($_GET['id'])) {
    $article = get_article($conn, $_GET['id']);
    if ($article) {
        $title =  $article['title'];
        $content =  $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("aricle not found");
    }
} else {

    die("id not supplied,aricle not found");
}

?>


<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Edit article</h1>
    <?php require 'includes/article-form.php'; ?>
</div>
<?php require 'includes/footer.php'; ?>