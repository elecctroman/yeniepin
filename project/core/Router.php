<?php

namespace Project\Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(private readonly Response $response)
    {
    }

    public function get(string $path, callable|array $handler): void
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = $this->normalize(parse_url($uri, PHP_URL_PATH) ?: '/');
        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            $this->response->html('Sayfa bulunamadı', 404);
            return;
        }

        if (is_array($handler)) {
            [$class, $action] = $handler;
            $controller = new $class($this->response, new View());
            $controller->{$action}();
            return;
        }

        $handler($this->response);
    }

    private function normalize(string $path): string
    {
        return '/' . trim($path, '/') ?: '/';
    }
}
