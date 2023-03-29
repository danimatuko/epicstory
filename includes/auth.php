<?php

/**
 * Return use authentication status
 *
 * @return boolean True if user is logged in, false otherwise
 */
function is_logged_in() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}
