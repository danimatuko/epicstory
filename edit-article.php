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
        exit("aricle not found");
    }
} else {

    exit("id not supplied,aricle not found");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = db_connent();
    // get form values
    $title =  $_POST['title'];
    $content =  trim($_POST['content']); // remove whitespaces cauesd by the html formatting
    $published_at =  $_POST['published_at'];

    $errors = validate_article($title, $content, $published_at);


    if (empty($errors)) {
        exit('form is valid');
    }
}

?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Edit article</h1>
    <?php require 'includes/article-form.php'; ?>
</div>
<?php require 'includes/footer.php'; ?>