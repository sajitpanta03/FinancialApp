<?php

namespace core;

class Router
{
    private static $router;

    private function __construct(private array $routes = [])
    {
    }

    public static function getRouter(): self
    {
        if (!isset(self::$router)) {
            self::$router = new self();
        }

        return self::$router;
    }

    public function get(string $uri, string $action): void
    {
        $this->register($uri, $action, "GET");
    }

    public function post(string $uri, string $action): void
    {
        $this->register($uri, $action, "POST");
    }

    public function put(string $uri, string $action): void
    {
        $this->register($uri, $action, "PUT");
    }

    public function delete(string $uri, string $action): void
    {
        $this->register($uri, $action, "DELETE");
    }

    protected function register(string $uri, string $action, string $method): void
    {
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }

        list($controller, $function) = $this->extractAction($action);

        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'method' => $function,
        ];
    }

    protected function extractAction(string $action, string $separator = '@'): array
    {
        $sepIdx = strpos($action, $separator);
        $controller = substr($action, 0, $sepIdx);
        $function = substr($action, $sepIdx + 1);

        return [$controller, $function];
    }

    public function route(string $method, string $uri): void
    {
        $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        $uri = str_replace($basePath, '', $uri);
        $uri = rtrim($uri, '/') ?: '/';
    
        foreach ($this->routes[$method] as $route => $result) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
    
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                $params = [];
                preg_match_all('/\{([^}]+)\}/', $route, $paramNames);
                $paramNames = $paramNames[1];
    
                foreach ($paramNames as $index => $paramName) {
                    $params[$paramName] = $matches[$index + 1];
                }
    
                $controller = $result['controller'];
                $function = $result['method'];
    
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
    
                    if (method_exists($controllerInstance, $function)) {
                        // Pass parameters to controller method
                        $controllerInstance->$function(...array_values($params));
                        return;
                    } else {
                        abort("No method {$function} on class {$controller}", 500);
                    }
                } else {
                    abort("Class {$controller} not found", 500);
                }
            }
        }
    
        abort("Route not found", 404);
    }    
    

}
