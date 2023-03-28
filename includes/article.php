<?php


/**
 * Get the aricle record based on id
 *
 * @param object  $conn Connection to database
 * @param integer $id the aricle ID
 * @return mixed An associative array containing the article with that ID, or null if not found
 */
function get_article($conn, $id) {

    $sql = "SELECT * 
        FROM article 
        WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_errno($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * Validate the article properties
 *
 * @param string $title, requied
 * @param string $content, required
 * @param string $published_at fromatted as date
 * @return array An array of error messages
 */
function validate_article($title, $content, $published_at) {
    $errors = [];

    if ($title == '') {
        $errors[] = 'Title is required';
    }

    if ($content == '') {
        $errors[] = 'Content is required';
    }

    return $errors;
}
