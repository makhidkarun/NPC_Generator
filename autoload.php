<?php

namespace NPC_Generator;

function __autoload($class)
{
    $file = './' . $class . '.php';
    $file = str_replace('\\', '/', $file);
    echo "file is $file\n";
    if (file_exists($file)) {
        require $file;
    } else {
        echo "file is $file.\n";
        throw new Exception("Unable to load $file.");
    }
}


