<?php

spl_autoload_register(function ($class) {
    // Convert namespace to full file path
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/src/';

    // Get the relative class name
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If the class does not use the prefix, move to the next registered autoloader
        return;
    }

    $relative_class = substr($class, $len);

    // Replace namespace separators with directory separators
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
