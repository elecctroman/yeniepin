<?php

namespace Project\Core;

function base_path(string $path = ''): string
{
    $base = dirname(__DIR__);
    return $path ? $base . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $base;
}

function config(string $key, mixed $default = null): mixed
{
    static $config;
    if ($config === null) {
        $config = require base_path('config/config.php');
    }

    return $config[$key] ?? $default;
}
