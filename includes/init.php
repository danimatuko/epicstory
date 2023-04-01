<?php

/**
 * initialisation
 * 
 * Register an autoloader
 */
spl_autoload_register(function ($class) {
    require "classes/{$class}.php";
});
