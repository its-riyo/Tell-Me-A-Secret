<?php

    namespace Core\Resources;

    /**
     * This class is responsable for sending headers errors
     * , redirections, etc.. Everything related to responses that a server can have
     */

    class Response 
    {

        // Redirect to a selected location
        public static function redirect(String $location, int $code = 200):void {
            header("Location: ".$location,$code);
            exit;
        }

        // Send error's headers
        public static function error(String $header, int $code) {
            header($header, $code);
            http_response_code($code);
            exit;
        }

    }