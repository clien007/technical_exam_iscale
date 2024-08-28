<?php

/**
 * PSR-4 Autoloader
 *
 * Automatically loads classes based on their namespace and class name.
 * This implementation follows the PSR-4 autoloading standard.
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {
    $prefix = 'App\\'; // Project-specific namespace prefix
    $baseDir = __DIR__ . '/src/'; // Base directory for the namespace prefix

    // Check if the class uses the namespace prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Move to the next registered autoloader if the prefix does not match
        return;
    }

    // Get the relative class name
    $relativeClass = substr($class, $len);

    // Replace the namespace prefix with the base directory,
    // replace namespace separators with directory separators,
    // and append with .php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Require the file if it exists
    if (file_exists($file)) {
        require $file;
    }
});
