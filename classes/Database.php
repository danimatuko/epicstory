<?php

/**
 * Connection to the database
 */
class Database {
    /**
     * Get the database connection
     *
     * @return object PDO connection to the database
     */
    public function getConn() {
        $host = "localhost";
        $db = "cms";
        $username = "danimatuko";
        $password = "J0Ip1TY8@x/PWeC4";

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

        try {
            $db = new PDO($dsn, $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
