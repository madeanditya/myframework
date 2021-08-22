<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function routes()
    {
        return $this->routes;
    }
    
    public function get(string $route, callable|array $action): self
    {
        $this->routes['get'][$route] = $action;
        return $this;
    }

    public function post(string $route, callable|array $action): self
    {
        $this->routes['post'][$route] = $action;
        return $this;
    }

    public function resolve($requestURI, $requestMethod)
    {
        $route = explode('?', $requestURI)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $class = new $class;                
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}