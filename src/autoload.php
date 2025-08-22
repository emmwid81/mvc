<?php

/**
 * Autoloader for class files.
 * @param string $class name of class.
 */
spl_autoload_register(function ($class) {
    //echo "$class<br>";
    $path = "src/{$class}.php";
    if (is_file($path)) {
        include($path);
    }
});
