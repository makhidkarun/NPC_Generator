<?php

namespace NPC_Generator;

function __autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($classname, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPATATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className);

    require $fileName;
}
/*
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

*/
