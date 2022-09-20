<?php

    use Core\App;
    
    /**
    * Composer autoload PSR-4 id being used to
    * autoload every single class :)
    */
    require "../vendor/autoload.php";

    /**
     * Creating a new app.
     * This line is bootstraping all resources that we need
     * using a construct method :)
     */
    define("BASE_PATH", __DIR__."../");

    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();

    $app = new App();