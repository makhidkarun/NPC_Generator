<?php

function __autoload($class)
{
    $file = './' . $class . '.php';
    if (file_exists($file)) {
    //    echo "How about that $file!";
        require_once $file;
    } else {
    //    echo "$file does not exist.";
        throw new Exception("Unable to load $file.");
    }
}


