<?php

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
}