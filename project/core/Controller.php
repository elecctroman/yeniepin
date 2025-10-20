<?php

namespace Project\Core;

abstract class Controller
{
    public function __construct(
        protected readonly Response $response,
        protected readonly View $view
    ) {
    }
}
