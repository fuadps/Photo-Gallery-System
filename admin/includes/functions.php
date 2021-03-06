<?php

function redirect($location) {
    header("Location: {$location}");
}

//this function find missing classes in file and included it.
function classAutoLoader($class) {
    $class = strtolower($class);
    $the_path = INCLUDE_PATH.DS.$class.".php";

    if (is_file($the_path) && !class_exists($class)) {
        include($the_path);
    }
    else {
        die("Class for {$class}.php not found...");
    }
}

spl_autoload_register('classAutoLoader');

?>