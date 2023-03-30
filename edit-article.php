<?php

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/header.php';
require 'includes/article.php';


$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        exit("aricle not found");
    }
} else {
    exit("id not supplied,aricle not found");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // get form values
    $article->title = $_POST['title'];
    $article->content = trim($_POST['content']); // remove whitespaces cauesd by the html formatting
    $article->published_at = $_POST['published_at'];

    $errors = validate_article($article->title, $article->content, $article->published_at);

    if (empty($errors)) {
        if ($article->update($conn)) {
            header("Location: article.php?id={$article->id}");
        }
    }
}


?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Edit article</h1>
    <?php require 'includes/article-form.php'; ?>
</div>
<?php require 'includes/footer.php'; ?>