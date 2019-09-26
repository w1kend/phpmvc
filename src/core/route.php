<?php

namespace src\core;

class Route
{
    public static function start()
    {
        $controllerName = 'page';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($c = $routes[1])) {
            $controllerName  = explode('?', $c)[0];
        }
        if (isset($routes[2]) && !empty($a = $routes[2])) {
            $actionName  = explode('?', $a)[0];
        }
        

        $modelName  = strtolower('Model_' . $controllerName);
        $controllerName  = strtolower('Controller_' . $controllerName);
        $actionName  = strtolower('action_' . $actionName);
        $controllerPath = "src/controllers/" . $controllerName . '.php';
        if (file_exists($controllerPath)) {
            include $controllerPath;
        } else {
            self::ErrorPage404();
        }
        $controller = new $controllerName();

        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            self::ErrorPage404();
            return;
        }
    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.x 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
