<?php

namespace Project\Core;

final class CSRF
{
    private const TOKEN_KEY = '_csrf_token';

    public static function token(): string
    {
        $token = Session::get(self::TOKEN_KEY);
        if (!$token) {
            $token = bin2hex(random_bytes(32));
            Session::set(self::TOKEN_KEY, $token);
        }

        return $token;
    }

    public static function validate(string $token): bool
    {
        $stored = Session::get(self::TOKEN_KEY);
        return is_string($stored) && hash_equals($stored, $token);
    }
}
