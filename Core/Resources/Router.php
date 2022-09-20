<?php

    namespace Core\Resources;
    use Core\Auxiliaries\RouterAuxi;
    use Routes\Web;

    /*
     * This class has all the routing logic. Here we store and register
     * every route defined within Routes/web.php 
     * This class uses a trait to register especial routes that uses controllers
     * or parameters :).
     * 
    */
    
    class Router 
    {

        // Auxiliar router trait
        use RouterAuxi;

        // Saving all routes
        public static $routes = [];

        // Method to create a new get route
        public static function get(String $route, $action):void {


            // Call an Auxiliar trait to check if the route has parameters
            // If so we store it within this route
            if(!self::hasParams($route, $action, "GET")) {

                // Check if the router is using a controller
                if(!self::hasController($route, $action, "GET")) {
                    // If not, store a 'common' route
                    self::$routes['GET'][$route]['action'] = $action;
                }
                    
            };

        }

        // Method to create a new post route
        public static function post(String $route, $action):void {
            
                // Call an Auxiliar trait to check if the route has parameters
                // If so we store it within this route
                if(!self::hasParams($route, $action, "POST")) {

                    // Check if the router is using a controller
                    if(!self::hasController($route, $action, "POST")) {
                        // If not, store a 'common' route
                        self::$routes['POST'][$route]['action'] = $action;
                    }
                    
                };

        }

        // Method to create a new delete route
        public static function delete(String $route, $action):void {
            
                // Call an Auxiliar trait to check if the route has parameters
                // If so we store it within this route
                if(!self::hasParams($route, $action, "DELETE")) {

                    // Check if the router is using a controller
                    if(!self::hasController($route, $action, "DELETE")) {
                        // If not, store a 'common' route
                        self::$routes['DELETE'][$route]['action'] = $action;
                    }
                    
                };

        }

        // Method to create a new put (Update) route
        public static function put(String $route, $action):void {

                // Call an Auxiliar trait to check if the route has parameters
                // If so we store it within this route
                if(!self::hasParams($route, $action, "PUT")) {

                    // Check if the router is using a controller
                    if(!self::hasController($route, $action, "PUT")) {
                        // If not, store a 'common' route
                        self::$routes['PUT'][$route]['action'] = $action;
                    }
                    
                };

        }

        //  Set all routes, save them and then dispatch them
        public static function dispatch():void {

            // Set all routes defined in Routes/Web.php
            Web::set();

            // Get the requested closure for the current URI
            $requestedRoute = self::$routes[Request::$requestMethod][Request::$uri];

            // Check if it existis
            if($requestedRoute) {
                
                // Store all params in a single variable
                $params = self::$params;

                // Check if its using a closure or controller method
                if ($requestedRoute['controller']) {
                    //Run controller method
                    call_user_func([$requestedRoute['controller'], $requestedRoute['method']], $params);
                } else {
                    // Run simple closure
                    $requestedRoute['action']($params);
                }
                
            } else {
                // Sending headers with error message
                Response::error("Error: Route not found", 404);
            };
        }

    }