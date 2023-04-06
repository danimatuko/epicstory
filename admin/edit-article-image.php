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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // var_dump($_FILES);

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
        if ($_FILES['file']['size'] > 1000000) {
            throw new Exception('File is too large');
        }

        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }

        $destination = "../uploads/" . $_FILES['file']['name'];
        $file_uploaed =   move_uploaded_file($_FILES['file']['tmp_name'], $destination);

        if ($file_uploaed) {
            echo "File uploaded successfully";
        } else {
            throw new Exception('Unable to move uploaded file');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<?php require '../includes/header.php'; ?>

<div class="w-50 m-auto">

    <h1 class="display-3 mb-5 text-center">Edit article image</h1>


    <form method="POST" enctype="multipart/form-data" class="w-50 m-auto">
        <div class="mb-3">
            <label for="file" class="form-label">Image upload</label>
            <input type="file" class="form-control" id="file" name="file" value="<?= htmlspecialchars($article->image); ?>">
        </div>

        <button type="submit" class="btn btn-dark w-100">Upload</button>
    </form>
</div>

<?php require '../includes/footer.php'; ?>