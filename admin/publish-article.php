<?php

require '../includes/init.php';


$conn = $db->getConn();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestBody = file_get_contents('php://input'); // get data from the request body
    $requestBody = json_decode($requestBody);
    $id = $requestBody->id;

    $article = Article::getById($conn, $id);
    $article->publish($conn);
}
