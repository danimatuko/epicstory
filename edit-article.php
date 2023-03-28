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

<?php

echo '<pre>', var_dump($article), '</pre>'; ?>