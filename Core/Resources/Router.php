<?php

    namespace Core\Resources;
    use Closure;

    class Router 
    {

        // Saving all routes
        public static $routes = [];

        // Method to create a new get route
        public static function get($route, Closure $action) {
            
            self::$routes['GET'][$route] = $action;

        }

        // Method to create a new post route
        public static function post($route, Closure $action) {
            
            self::$routes['POST'][$route] = $action;

        }

        // Method to create a new delete route
        public static function delete($route, Closure $action) {
            
            self::$routes['DELETE'][$route] = $action;

        }

        // Method to create a new put (Update) route
        public static function put($route, Closure $action) {
            
            self::$routes['PUT'][$route] = $action;

        }

        // Check if the URI match and then dispatch the function
        public static function dispatch() {
            $request = new Request();

            $uri = $request::$uri;
            $requestMethod = $request::$requestMethod; 
            $routes = self::$routes;

            if($routes[$requestMethod][$uri]) {
                $routes[$requestMethod][$uri]();
            } else {
                echo "Route not found!";
            };
        }

    }