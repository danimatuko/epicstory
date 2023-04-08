<?php

class ImageUploader {
    public $file;
    public $filename;
    public $destination;
    private $allowedMimeTypes = ['image/gif', 'image/png', 'image/jpeg'];
    private $maxFileSize = 1000000; // 1MB
    private $targetDir = '..uploads/';


    public function __construct($file) {
        $this->file = $file;
        $this->filename = pathinfo($this->file['name'], PATHINFO_FILENAME);
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
        $pathinfo = pathinfo($this->file['name']);
        // sanitizse filename and create path to upload
        $base = $pathinfo['filename'];
        $base = preg_replace('/[^a-zA-Z0-9_-]/', "_", $base);

        $this->filename = $base . "." . $pathinfo['extension'];
        $this->destination = "../uploads/$this->filename";
    }

    public function upload() {
        $file_uploaded = move_uploaded_file($_FILES['file']['tmp_name'], $this->destination);
    }
}
