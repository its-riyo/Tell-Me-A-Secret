<?php

    namespace Core;

    use Core\Resources\Request;
    use Core\Resources\Router;

    /**
     * This is the App class wich is responsable for bootstraping
     * all the application, it bootstraps everything using a
     * construct method called when we instantiate it in Index.php :)
     */

    class App 
    {

        function __construct()
        {   
            // Get information about the current request
            Request::dispatch();

            // Set all defined routes and dispatch them to the signed URI
            Router::dispatch();
            
        }


    }