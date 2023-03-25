<?php require 'includes/database.php'; ?>
<?php require 'includes/header.php'; ?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = db_connent();

    $title = mysqli_escape_string($conn, $_POST['title']);
    $content = mysqli_escape_string($conn, $_POST['content']);
    $published_at = mysqli_escape_string($conn, $_POST['published_at']);

    $sql = "INSERT INTO article (title,content,published_at)
            VALUES (?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);
        if (mysqli_stmt_execute($stmt)) {
            $id = mysqli_insert_id($conn);
            echo "Inserted record with ID: $id";
        } else {
            mysqli_stmt_error($stmt);
        }
    }
}

?>

<div class="w-75 m-auto">

    <h1 class="display-3 mb-5">New article</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="name" name="title">
        </div>
        <div class="mb-3">
            <label for="content">Content</label>
            <textarea class="form-control" placeholder="Write a content here" id="content" name="content" rows=4></textarea>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Publish date and time</label>
            <input type="datetime-local" class="form-control" id="published_at" name="published_at">
        </div>
        <button type="submit" class="btn btn-dark">Submit</button>
    </form>
</div>
<?php require 'includes/footer.php'; ?>