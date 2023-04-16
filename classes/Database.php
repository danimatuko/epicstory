<?php

/**
 * Connection to the database
 */
class Database {
    private $host;
    private $db;
    private $username;
    private $password;


    /**
     * Contructor
     *
     * @param string $host Host name 
     * @param string $db Database name
     * @param string $username User name
     * @param string $password Password
     */
    public function __construct($host, $db, $username, $password) {
        $this->host = $host;
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }


    /**
     * Get the database connection
     *
     * @return object PDO connection to the database
     */
    public function getConn() {


        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=utf8";

        try {
            $db = new PDO($dsn, $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
