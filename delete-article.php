<?php

require 'includes/database.php';
require 'includes/article.php';


$conn = db_connent();

if (isset($_GET['id'])) {
    $article = get_article($conn, $_GET['id'], 'id,title');

    if ($article) {
        $id = $article['id'];
        $title =  $article['title'];
    } else {
        exit("aricle not found");
    }
} else {
    exit("id not supplied,aricle not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM article 
        WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            mysqli_stmt_error($stmt);
        }
    }
}

?>


<?php require 'includes/header.php'; ?>
<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">Delete article</h1>
    <p>Are you sure you want to delete the article
        <strong>
            <?= $title ?>
        </strong>
    </p>
    <form action="delete-article.php?id=<?= $article['id']; ?>" method="post">
        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
    </form>
</div>
<?php require 'includes/footer.php'; ?>