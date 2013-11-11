<?php

// namespace NPC_Generator;

function __autoload($class)
{
    $file = './' . $class . '.php';
    $file = str_replace('\\', '/', $file);
    if (file_exists($file)) {
    //    echo "How about that $file!";
        require $file;
    } else {
    //    echo "$file does not exist.";
        throw new Exception("Unable to load $file.");
    }
}


