<?php

/**
 * initialisation
 * 
 * Register an autoloader
 */
spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});
