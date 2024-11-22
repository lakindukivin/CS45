<?php

class Router {
    private $routes = [];

    public function __construct() {
        // Define your routes
        $this->routes = [
            '/' => ['controller' => 'HomeController', 'action' => 'index'],
            '/about' => ['controller' => 'PageController', 'action' => 'about'],
        ];
    }

    public function run() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($url, $this->routes)) {
            $controllerName = $this->routes[$url]['controller'];
            $actionName = $this->routes[$url]['action'];

            $this->dispatch($controllerName, $actionName);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }

    private function dispatch($controllerName, $actionName) {
        require_once "../app/controllers/$controllerName.php";
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            echo "Action $actionName not found!";
        }
    }
}
