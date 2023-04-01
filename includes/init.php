<?php

/**
 * initialisation
 * 
 * Register an autoloader, start or resume the session
 * Any class will be required from the root directory with absolute path
 */
spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});

session_start();
