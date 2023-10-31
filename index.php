<?php

declare(strict_types=1);

use App\Models\Article;

require_once 'vendor/autoload.php';
{
    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
        $router->addRoute('GET', '/articles', ['App\Controllers\ArticleController', 'index']);
        $router->addRoute('GET', '/article', ['App\Controllers\ArticleController', 'show']);
    });

// Fetch method and URI from somewhere
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            // ... 404 Not Found
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // ... 405 Method Not Allowed
            break;
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            [$className, $method] = $handler;
            $response = (new $className)->{$method}();
            /**
             * @var Article $item
             */
            foreach ($response as $item) {
                echo $item->getTitle() . "</br>";
                echo $item->getContent() . "</br>";
            }

            break;
    }
}