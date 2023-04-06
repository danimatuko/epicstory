<?php

// phpinfo();

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    echo '<pre>', var_dump($_FILES), '</pre>';


    try {
        if (empty($_FILES)) {
            throw new Exception("Invalid upload");
        }

        if ($_FILES['file']['size'] > 1000000) {
            throw new Exception('The max file size is 1MB');
        }
        $code = $_FILES['file']['error'];


        switch ($code) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception("The uploaded file exceeds the upload_max_filesize directive in php.ini");
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception("No file was uploaded");
                break;

            default:
                throw new Exception("Unknown upload error");
                break;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5 text-center">Edit article image</h1>


    <form method="POST" enctype="multipart/form-data" novalidate class="w-50 m-auto">
        <div class="mb-3">
            <label for="file" class="form-label">Image upload</label>
            <input type="file" class="form-control" id="file" name="file" value="<?= htmlspecialchars($article->image); ?>">
        </div>

        <button type="submit" class="btn btn-dark w-100">Upload</button>
    </form>
</div>

<?php require '../includes/footer.php'; ?>