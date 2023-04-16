<?php
require dirname(__DIR__)  . "/config.php";

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

/**
 * Connect to the database
 */
$db = new Database(HOST, DB, USERNAME, PASSWORD);
$conn = $db->getConn();



/**
 * Catch errors, covert them to exceptions and throw
 */
function errorHandler($level, $message, $file, $line) {
    throw new ErrorException($message, 0, $level, $file, $line);
}


/**
 * Catch and handle exceptions 
 */
function exceptionHandler($exception) {
    if (SHOW_ERROR_DETAILS) {

        echo "<h1>An error occurred</h1>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>In file '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
    } else {

        echo "<h1>An error occurred</h1>";
        echo "<p>Please try again later.</p>";
    }

    exit();
}

set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');
