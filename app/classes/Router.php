<?php

namespace App\clasess;
use FastRoute;
use App\controllers\pageControllers;

class Router{



    public static function rout(){
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['App\controllers\pageControllers', 'index']);
            $r->addRoute('GET', '/add', ['App\controllers\pageControllers', 'add']);
            $r->addRoute('GET', '/about', ['App\controllers\pageControllers', 'about']);
            $r->addRoute('GET', '/register', ['App\controllers\pageControllers', 'registerPage']);
            $r->addRoute('GET', '/auth', ['App\controllers\pageControllers', 'authPage']);
            $r->addRoute('GET', '/page/{id:\d+}', ['App\controllers\pageControllers', 'page']);
            $r->addRoute('GET', '/delete/{id:\d+}', ['App\controllers\pageControllers', 'delete']);
            $r->addRoute('GET', '/view/{id:\d+}', ['App\controllers\pageControllers', 'view']);
            $r->addRoute('GET', '/edit/{id:\d+}', ['App\controllers\pageControllers', 'edit']);
            $r->addRoute('GET', '/logout', ['App\controllers\pageControllers', 'logout']);
            $r->addRoute('GET', '/user-page', ['App\controllers\pageControllers', 'user_page']);

            $r->addRoute('POST', '/create-user', ['App\controllers\pageControllers', 'create_user']);
            $r->addRoute('POST', '/log-in', ['App\controllers\pageControllers', 'log_in']);
            $r->addRoute('POST', '/store', ['App\controllers\pageControllers', 'store']);
            $r->addRoute('POST', '/update', ['App\controllers\pageControllers', 'update']);


            // {id} must be a number (\d+)
           // $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
            // The /{title} suffix is optional
            //$r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];


        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                echo "404";
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:

                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                $controller = new $handler[0];

                call_user_func([$controller, $handler[1]], $vars);
                break;
        }
    }
}
