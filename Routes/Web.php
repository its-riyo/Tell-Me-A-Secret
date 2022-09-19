<?php

    namespace Routes;

    use App\Http\Controllers\userController;
    use Core\Resources\Router;

    /**
     * Here you can register any route 
     * you need :) 
     */

     class Web
     {

        // Register all routes inside this function!
        public static function set() {
            
            Router::post("/post", function () {
                echo 'hi';
           });

            Router::get("/", function () {
                echo "home";
            });

            Router::get("/posts/{id}", function ($params) {
                print_r($params);
            });

            Router::get("/controller/{id}", [userController::class, 'controller']);

        }

     }