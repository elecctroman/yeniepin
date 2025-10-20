<?php

namespace Project\Core;

use PDO;
use PDOException;

class Bootstrap
{
    private array $config = [];
    private Router $router;

    public function __construct(private readonly string $basePath)
    {
        Env::load($this->basePath . '/.env.php');
        $this->config = require $this->basePath . '/config/config.php';

        date_default_timezone_set($this->config['timezone'] ?? 'UTC');
        mb_internal_encoding('UTF-8');

        Session::start();
        Security::enforceHeaders();

        $this->router = new Router(new Response());
        $this->registerRoutes();
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->router->dispatch($method, $uri);
    }

    public function router(): Router
    {
        return $this->router;
    }

    public function pdo(): ?PDO
    {
        $db = require $this->basePath . '/config/database.php';
        try {
            return new PDO(
                sprintf('mysql:host=%s;dbname=%s;charset=%s', $db['host'], $db['database'], $db['charset']),
                $db['username'],
                $db['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException) {
            return null;
        }
    }

    private function registerRoutes(): void
    {
        $routes = require $this->basePath . '/config/routes.php';
        $routes($this->router);
    }
}
