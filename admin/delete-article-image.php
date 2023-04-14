<?php

require '../includes/init.php';

Auth::requireLogin();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if ($article->image_path) {
        $article->setImagePath($conn, null); // passing null will delete the path from the database
        // remove the image 
        unlink("../uploads/$article->image_path");

        header("Location: /admin/article.php?id={$article->id}");
    } else {
        throw new Exception('Unable to move uploaded file');
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Delete article image</h1>
    <p>Are you sure you want to delete the article image
        <strong>
            <?= $article->title ?>
        </strong>
    </p>
    <div class="d-flex gap-2">
        <form method="POST">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
        </form>
        <a href="edit-article-image.php?id=<?= $article->id ?>" class="btn btn-sm btn-outline-secondary">Cancel</a>
    </div>
</div>



<?php require '../includes/footer.php'; ?>