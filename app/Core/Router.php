<?php

namespace app\Core;

class Router {
    protected $routes = [];

    public function get($uri, $controllerAction, $middlewares = []) {
        $this->addRoute('GET', $uri, $controllerAction, $middlewares);
    }

    public function post($uri, $controllerAction, $middlewares = []) {
        $this->addRoute('POST', $uri, $controllerAction, $middlewares);
    }

    private function addRoute($method, $uri, $controllerAction, $middlewares) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controllerAction' => $controllerAction,
            'middlewares' => $middlewares
        ];
    }

    public function dispatch($uri, $method) {
        foreach ($this->routes as $route) {
            // Simple exact match logic first (can be improved for dynamic params later)
            if ($route['uri'] === $uri && $route['method'] === $method) {
                
                // Run middlewares here if needed
                foreach($route['middlewares'] as $middleware) {
                    $args = [];
                    if (strpos($middleware, ':') !== false) {
                        list($middleware, $argsStr) = explode(':', $middleware);
                        $args = explode(',', $argsStr);
                    }

                    $middlewareClass = "app\\middleware\\" . $middleware;
                    $middlewareInstance = new $middlewareClass();
                    if(!call_user_func_array([$middlewareInstance, 'handle'], $args)) {
                        return; // Blocked by middleware
                    }
                }

                // Call the controller
                list($controller, $action) = explode('@', $route['controllerAction']);
                $controllerClass = "app\\controllers\\" . $controller;
                
                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    if (method_exists($controllerInstance, $action)) {
                        $controllerInstance->$action();
                    } else {
                        $this->abort(404, "Method $action not found in $controllerClass");
                    }
                } else {
                    $this->abort(404, "Controller $controllerClass not found");
                }
                return;
            }
        }

        $this->abort(404);
    }

    private function abort($code = 404, $message = "Page Not Found") {
        http_response_code($code);
        echo "<h1>$code - $message</h1>";
        exit;
    }
}
