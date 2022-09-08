<?php

    namespace Routes;

    use Core\Resources\Router;

    /**
     * Here you can register all of the routes that 
     * you need :) 
     */

     class Web
     {

        // Register all routes inside this function!
        public static function set() {
            
            Router::get("/", function () {
                echo 'ur home';
            });
        
            Router::get("/testing", function () {
                echo "Testing working";
            });
        
            Router::post("/anotherpost", function () {
                die(json_encode(["Hey" => "Everything is working just fine!"]));
            });
        }

     }