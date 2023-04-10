<?php
class Category {
    /**
     * Get all categories
     *
     * @param object $conn connection to the database       
     * @return array associative array of all category records
     */
    public static function getAll($conn) {
        $sql = "SELECT * 
                FROM category
                ORDER BY name";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
}
