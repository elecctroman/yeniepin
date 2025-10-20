<?php

namespace Project\Core;

class Cache
{
    public function __construct(private readonly string $path)
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0775, true);
        }
    }

    public function put(string $key, mixed $value, int $ttl = 300): void
    {
        $payload = [
            'expires_at' => time() + $ttl,
            'value' => $value,
        ];
        file_put_contents($this->file($key), serialize($payload), LOCK_EX);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $file = $this->file($key);
        if (!is_file($file)) {
            return $default;
        }
        $payload = @unserialize((string) file_get_contents($file));
        if (!is_array($payload) || ($payload['expires_at'] ?? 0) < time()) {
            @unlink($file);
            return $default;
        }
        return $payload['value'];
    }

    private function file(string $key): string
    {
        return rtrim($this->path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . md5($key) . '.cache';
    }
}
