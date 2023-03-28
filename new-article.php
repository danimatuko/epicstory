<?php require 'includes/database.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/article.php'; ?>

<?php

$title =  '';
$content =  '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = db_connent();
    // get form values
    $title =  $_POST['title'];
    $content =  trim($_POST['content']); // remove whitespaces cauesd by the html formatting
    $published_at =  $_POST['published_at'];

    $errors = validate_article($title, $content, $published_at);

    if (empty($errors)) {

        $sql = "INSERT INTO article (title,content,published_at)
            VALUES (?,?,?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $title, $content,  $published_at);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
                header("Location: article.php?id=$id");
                exit;
            } else {
                mysqli_stmt_error($stmt);
            }
        }
    }
}
?>
<div class="w-50 m-auto">

    <h1 class="display-3 mb-5">New article</h1>
    <?php require 'includes/article-form.php'; ?>
</div>
<?php require 'includes/footer.php'; ?>