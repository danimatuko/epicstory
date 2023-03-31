<?php

/**
 * User
 * 
 * Person or entity that can log in to the site
 */
class User {
    public $id;
    public $username;
    public $password;


    /**
     * Authenticate user by username and password
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public static function authenticate($conn, $username, $password) {
        $sql = "SELECT * FROM user
                WHERE username = :username";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            return $user->password === $password;
        }
    }
}
