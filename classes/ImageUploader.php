<?php

/**
 * Image uploader
 * 
 * Handle image uploads
 */
class ImageUploader {
    private $file;
    private $filename;
    private $destination;
    private $allowedMimeTypes;
    private $maxFileSize;
    private $targetDir;
    private $pathInfo;



    public function __construct($file) {
        $this->file = $file;
        $this->filename =  $this->file['name'];
        $this->destination =  $this->targetDir . $this->filename;
        $this->allowedMimeTypes = ['image/gif', 'image/png', 'image/jpeg'];
        $this->maxFileSize = 1000000; // 1MB
        $this->targetDir = "../uploads/";
        $this->pathInfo =  pathinfo($this->file['name']);
    }


    /**
     * Handle errors from the $_FILES array: https://www.php.net/manual/en/features.file-upload.errors.php
     *
     * @return object Execption with a an error message
     */
    public function uploadErrorCheck() {
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
                throw new Exception('The uploaded file exceeds the upload_max_filesize in the server');
                break;

            default:
                throw new Exception('An error occurred');
        }
    }


    /**
     * Check the file size
     *
     * @return void Throws exception if the file size is larger then the maxFileSize
     */
    public function checkSize() {
        if ($this->file['size'] > $this->maxFileSize) {
            throw new Exception('File is too large');
        }
    }



    /**
     * Check file type
     *
     * @return void Throws exception if the file type is none of the allowedMimeTypes array
     */
    public function checkType() {

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $this->allowedMimeTypes)) {
            throw new Exception('Invalid file type');
        }
    }

    /**
     * Replace any characters that aren't letters, numbers, underscores or hyphens with an underscore
     *
     * @return void
     */
    public function sanitizseFileName() {
        // sanitizse filename and create path to upload
        $base = $this->pathInfo['filename'];
        $base = preg_replace('/[^a-zA-Z0-9_-]/', "_", $base);

        $this->filename = $base . "." . $this->pathInfo['extension'];
        $this->destination = "../uploads/$this->filename";
    }

    /**
     * Add a numeric suffix to the filename to avoid overwriting existing files
     * 
     * @return void
     */
    public function setUniqueName() {
        $base = $this->pathInfo['filename'];

        $i = 1;
        while (file_exists($this->destination)) {
            $this->filename = $base . "-$i." . $this->pathInfo['extension'];
            $this->destination = "../uploads/$this->filename";
            $i++;
        }
    }


    /**
     * Upload image
     * 
     * Set a path to the image in the database
     *
     * @param object $conn connection to the database       
     * @param object $article Article object
     * @return void
     */
    public function upload($conn, $article) {
        $file_uploaded = move_uploaded_file($_FILES['file']['tmp_name'], $this->destination);

        if ($file_uploaded) {
            $previous_image_path = $article->image_path;
            // set new image path
            $pathHasChanged = $article->setImagePath($conn, $this->filename);
            // remove the previous image after new image update
            if ($pathHasChanged && $previous_image_path) {
                unlink("../uploads/$previous_image_path");
            }

            header("Location: /admin/article.php?id={$article->id}");
        } else {
            throw new Exception('Unable to move uploaded file');
        }
    }
}
