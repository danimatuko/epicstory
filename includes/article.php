<?php


/**
 * Get the aricle record based on id
 *
 * @param object  $conn Connection to database
 * @param integer $id the aricle ID
 * @param string $columns Optional list of columns for the select, defaults to all 
 * @return mixed An associative array containing the article with that ID, or null if not found
 */
function get_article($conn, $id, $columns = '*') {

    $sql = "SELECT $columns 
        FROM article 
        WHERE id = :id";

    $stmt =  $conn->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
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