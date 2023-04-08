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

    try {
        $imageUploader = new ImageUploader($_FILES['file']);
        $imageUploader->uploadErrorCheck();
        $imageUploader->checkSize();
        $imageUploader->checkType();
        $imageUploader->sanitizseFileName();
        $imageUploader->upload();
        echo '<pre>', var_dump($imageUploader->file), '</pre>';
    } catch (Exception $e) {
        $error =  $e->getMessage();
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error ?> </div>
    <?php endif; ?>

    <h1 class="display-3 mb-5 text-center">Edit article image</h1>

    <form method="POST" action="image-uploader.php?id=<?= $article->id ?>" enctype="multipart/form-data" class="w-50 m-auto mb-1">
        <div class="mb-3">
            <label for="file" class="form-label">Image upload</label>
            <input type="file" class="form-control" id="file" name="file" value="<?= htmlspecialchars($article->image); ?>">
        </div>

        <button type="submit" class="btn btn-dark w-100">Upload</button>
    </form>
    <?php if ($article->image_path) : ?>
        <a href="delete-article-image.php?id=<?= $article->id ?>" class="btn btn-sm btn-danger d-block w-50 m-auto fw-bold">Delete Image</a>
    <?php endif ?>
</div>

<?php require '../includes/footer.php'; ?>