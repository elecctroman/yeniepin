<?php

namespace Project\Core;

final class Env
{
    private static array $variables = [];

    public static function load(string $path): void
    {
        if (!is_file($path)) {
            return;
        }

        $data = include $path;
        if (is_array($data)) {
            self::$variables = array_merge(self::$variables, $data);
            foreach ($data as $key => $value) {
                if (!getenv($key)) {
                    putenv(sprintf('%s=%s', $key, $value));
                }
            }
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$variables[$key] ?? getenv($key) ?? $default;
    }
}
