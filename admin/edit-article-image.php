<?php

require '../includes/init.php';

Auth::requireLogin();


if (isset($_GET['id'])) {
    $article = Article::getById($conn, $_GET['id']);

    if (!$article) {
        exit("aricle not found");
    }
} else {
    exit("id not supplied,aricle not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $imageUploader = new ImageUploader($_FILES['file']);

        $imageUploader->uploadErrorCheck();
        $imageUploader->checkSize();
        $imageUploader->checkType();
        $imageUploader->sanitizseFileName();
        $imageUploader->setUniqueName();
        $imageUploader->upload($conn, $article);
    } catch (Exception $e) {
        $error =  $e->getMessage();
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col col-md-8 mx-auto"> <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= $error ?> </div>
            <?php endif; ?>

            <h1 class="display-3 mb-5 text-center">Edit article image</h1>

            <form method="POST" enctype="multipart/form-data" class="mb-1">
                <div class="mb-3">
                    <label for="file" class="form-label">Image upload</label>
                    <input type="file" class="form-control" id="file" name="file" value="<?= htmlspecialchars($article->image ?? ""); ?>">
                </div>

                <button type="submit" class="btn btn-dark w-100">Upload</button>
            </form>
            <?php if ($article->image_path) : ?>
                <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-danger w-100 fw-bold">Delete
                </button>
            <?php endif ?>
        </div>
    </div>
</div>


<?php require "includes/delete-modal.php";
?>

<?php require '../includes/footer.php'; ?>