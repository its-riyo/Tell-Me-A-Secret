<?php

    namespace Core;

use Core\Resources\Router;
use Routes\Web;

    class App 
    {

        function __construct()
        {   
            Web::set();
            Router::dispatch();
        }


    }