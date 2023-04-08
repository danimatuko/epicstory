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
    echo '<pre>', var_dump($_FILES), '</pre>';
    exit;

    try {

        if (empty($_FILES)) {
            throw new Exception('Invalid upload');
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;

            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
                break;

            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('File is too large (from the server settings)');
                break;

            default:
                throw new Exception('An error occurred');
        }

        // Restrict the file size
        if ($_FILES['file']['size'] > 3000000) {
            throw new Exception('File is too large');
        }

        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $pathinfo = pathinfo($_FILES['file']['name']);
        // sanitizse filename and create path to upload
        $base = $pathinfo['filename'];
        // Replace any characters that aren't letters, numbers, underscores or hyphens with an underscore
        $base = preg_replace('/[^a-zA-Z0-9_-]/', "_", $base);

        $filename = $base . "." . $pathinfo['extension'];

        $destination = "../uploads/$filename";

        // Add a numeric suffix to the filename to avoid overwriting existing files
        $i = 1;

        while (file_exists($destination)) {
            $filename = $base . "-$i." . $pathinfo['extension'];
            $destination = "../uploads/$filename";
            $i++;
        }

        // upload file
        $file_uploaded = move_uploaded_file($_FILES['file']['tmp_name'], $destination);

        if ($file_uploaded) {
            $previous_image_path = $article->image_path;
            // set new image path
            $pathHasChanged = $article->setImagePath($conn, $filename);
            // remove the previous image after new image update
            if ($pathHasChanged && $previous_image_path) {
                unlink("../uploads/$previous_image_path");
            }

            header("Location: /admin/article.php?id={$article->id}");
        } else {
            throw new Exception('Unable to move uploaded file');
        }
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

    <form method="POST" action="image-uploader.php?id=<?= $article->id ?>" enctype="multipart/form-data"
        class="w-50 m-auto mb-1">
        <div class="mb-3">
            <label for="file" class="form-label">Image upload</label>
            <input type="file" class="form-control" id="file" name="file"
                value="<?= htmlspecialchars($article->image); ?>">
        </div>

        <button type="submit" class="btn btn-dark w-100">Upload</button>
    </form>
    <?php if ($article->image_path) : ?>
    <a href="delete-article-image.php?id=<?= $article->id ?>"
        class="btn btn-sm btn-danger d-block w-50 m-auto fw-bold">Delete Image</a>
    <?php endif ?>
</div>

<?php require '../includes/footer.php'; ?>