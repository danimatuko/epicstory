<?php




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
