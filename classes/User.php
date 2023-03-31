<?php

/**
 * User
 * 
 * Person or entity that can log in to the site
 */
class User {
    /**
     * Authenticate user by username and password
     *
     * @param string $username
     * @param [string] $password
     * @return void
     */
    public static function authenticate($username, $password) {
        return ($username === 'dani' && $password === 'secret');
    }
}
