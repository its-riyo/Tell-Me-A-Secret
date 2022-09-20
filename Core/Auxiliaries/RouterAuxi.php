<?php

    namespace Core\Auxiliaries;

    use Core\Resources\Request;
    use Core\Resources\Router;
    /**
     * This trait is responsable for extra features useful to the router
     * like Params. All the trick is inside here. Enjoy :)
     */

    trait RouterAuxi
    {

        // Saving all routes's parameters if exists
        public static $params = [];

        // Saving all param's keys
        public static $paramKey = [];

        public static function hasParams(string $route, $action, $requestMethod):bool {
            // Check if curly braces exists
            // $match = preg_match("/{*}/", $route);

            preg_match_all("/(?<={).+?(?=})/", $route, $match);
            
            if (!empty($match[0])) {

                self::$params = [];
                self::$paramKey = [];

                $reqUri = Request::$uri;

                //setting parameters names
                foreach($match[0] as $key){
                    self::$paramKey[] = $key;
                }
                
                //replacing first and last forward slashes
                //$_REQUEST['uri'] will be empty if req uri is /
                if(!empty($reqUri)){
                    $route = preg_replace("/(^\/)|(\/$)/","",$route);
                    $reqUri =  preg_replace("/(^\/)|(\/$)/","",$reqUri);
                }else{
                    $reqUri = "/";
                }

                //exploding route address
                $uri = explode("/", $route);

                //will store index number where {?} parameter is required in the $route 
                $indexNum = []; 

                //storing index number, where {?} parameter is required with the help of regex
                foreach($uri as $index => $param){
                    if(preg_match("/{.*}/", $param)){
                        $indexNum[] = $index;
                    }
                }

                //exploding request uri string to array to get
                //the exact index number value of parameter from $_REQUEST['uri']
                $reqUri = explode("/", $reqUri);

                //running for each loop to set the exact index number with reg expression
                //this will help in matching route
                foreach($indexNum as $key => $index){

                    //in case if req uri with param index is empty then return
                    //because url is not valid for this route
                    if(empty($reqUri[$index])){
                        return false;
                    }

                    //setting params with params names
                    self::$params[self::$paramKey[$key]] = $reqUri[$index];

                    //this is to create a regex for comparing route address
                    $reqUri[$index] = "{.*}";
                }

                //converting array to sting
                $reqUri = implode("/",$reqUri);

                //replace all / with \/ for reg expression
                //regex to match route is ready !
                $reqUri = str_replace("/", '\\/', $reqUri);

                //now matching route with regex
                if(preg_match("/$reqUri/", $route))
                {
                    //$action(self::$params);
                    Router::$routes[$requestMethod][Request::$uri]['action'] = $action;
                    return true;
                }
            }

            return false;
        }


        // Check if a registerd route has a controller
        public static function hasController($route, $action, $requestMethod):bool {

            // If the action is an array, then the class is using a controller for logic
            if (is_array($action)) {
                // Get controller name and method
                $controller = $action[0];
                $method = $action[1];

                // Register them
                Router::$routes[$requestMethod][$route]['controller'] = $controller;
                Router::$routes[$requestMethod][$route]['method'] = $method;
                
                return True;
            }

            return False;
        }


    }