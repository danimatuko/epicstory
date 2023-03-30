<?php

/**
 * Article
 * 
 * A piece of writing for publiction
 */
class Article {
    /**
     * Get all articles
     *
     * @param object $conn connection to the database       
     * @return array an associative array of all article records
     */
    public static function getAll($conn) {
        $sql = "SELECT * 
        FROM article
        ORDER BY published_at";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get the aricle record based on id
     *
     * @param object  $conn Connection to database
     * @param integer $id the aricle ID
     * @param string $columns Optional list of columns for the select, defaults to all 
     * @return mixed An associative array containing the article with that ID, or null if not found
     */
    public static function getById($conn, $id, $columns = '*') {

        $sql = "SELECT $columns 
        FROM article 
        WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}
