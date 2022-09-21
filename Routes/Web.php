<?php

    namespace Routes;

    use Core\Resources\Router;

    /**
     * Here you can register any route 
     * you need :) 
     * Use the Router resource to define GET,POST,PUT or DELETE routes
     */

     class Web
     {

        // Register all routes inside this function!
        public static function set():void {

            Router::get("/", function () {
               echo $_ENV['AZURE_SSH_KEY'];
            });

        }

     }