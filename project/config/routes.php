<?php
use Project\Core\Router;

return static function (Router $router): void {
    $router->get('/', [\Project\App\Controllers\HomeController::class, 'index']);
};
