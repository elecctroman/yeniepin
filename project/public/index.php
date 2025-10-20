<?php

declare(strict_types=1);

spl_autoload_register(static function (string $class): void {
    $prefix = 'Project\\';
    $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
    if (str_starts_with($class, $prefix)) {
        $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, strlen($prefix)));
        $file = $baseDir . $relative . '.php';
        if (is_file($file)) {
            require $file;
        }
    }
});

$bootstrap = new \Project\Core\Bootstrap(dirname(__DIR__));
$bootstrap->run();
