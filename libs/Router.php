<?php
class Router {
    private $routes = [];

    public function addRoute($url, $controller, $method) {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    public function route($url) {
        if (array_key_exists($url, $this->routes)) {
            $controller = $this->routes[$url]['controller'];
            $method = $this->routes[$url]['method'];

            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            // Handle 404 Not Found
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
        }
    }
}