<?php

    namespace App\Http\Controllers;

    class userController
    {

        public static function controller($id) {
            echo "Controller called";
            print_r($id);
        }


    }