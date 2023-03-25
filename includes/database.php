<?php

/**
 * Get the database connection
 *
 * @return object Connection to MySQL server
 */
function db_connent() {
    $host = "localhost";
    $db = "cms";
    $username = "danimatuko";
    $password = "I_X5P2]zqClMRNaC";


    $conn = mysqli_connect($host, $username, $password, $db);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
