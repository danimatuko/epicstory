<?php

require '../includes/init.php';

Auth::requireLogin();

$db = new Database();

$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        exit("article not found");
    }
} else {
    exit("id not supplied,aricle not found");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($article->delete($conn)) {
        unlink("../uploads/$article->image_path");
        header("Location: index.php");
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Delete article</h1>
    <p>Are you sure you want to delete the article
        <strong>
            <?= $article->title ?>
        </strong>
    </p>
    <div class="d-flex gap-2">
        <form action="delete-article.php?id=<?= $article->id; ?>" method="post">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
        </form>
        <a href="article.php?id=<?= $article->id ?>" class="btn btn-sm btn-outline-secondary">Cancel</a>
    </div>
</div>
<?php require '../includes/footer.php'; ?>