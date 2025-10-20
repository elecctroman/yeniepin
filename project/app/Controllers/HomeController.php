<?php

namespace Project\App\Controllers;

use Project\Core\Controller;
use Project\Core\Response;
use Project\Core\View;

final class HomeController extends Controller
{
    public function __construct(Response $response, View $view)
    {
        parent::__construct($response, $view);
    }

    public function index(): void
    {
        $content = $this->view->render('home/index', [
            'title' => 'YeniePin Dijital Market',
        ]);

        $this->response->html($content);
    }
}
