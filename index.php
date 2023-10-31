<?php

declare(strict_types=1);

use App\Models\Article;
use App\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, [
    'cache' => 'compilation_cache',
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


{
    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
        $router->addRoute('GET', '/', ['App\Controllers\ArticleController', 'index']);
        $router->addRoute('GET', '/articles', ['App\Controllers\ArticleController', 'index']);
        $router->addRoute('GET', '/article/{id:\d+}', ['App\Controllers\ArticleController', 'show']);
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
            $id = (isset($vars['id'])) ? (int)$vars['id'] : null;
            /**
             * @var Response $response
             */
            $response = (new $className())->{$method}($id);

            $view = $response->getViewName();
            $data = $response->getData();
            echo $twig->render("$view.twig", $data);

            break;
    }
}