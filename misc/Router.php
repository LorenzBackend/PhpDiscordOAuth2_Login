<?php

class Router
{
    static $routes = [];

  
    static function Init(){
        $request = $_SERVER['REQUEST_URI'];
        $request = preg_replace("/\?.*/", "", $request);
        $exists = false;
        foreach(self::$routes as $route => $file){
         if ($request == $route){
            require($_SERVER['DOCUMENT_ROOT'] . $file);
            $exists = true;
            break;
         }
        }

        if (!$exists){
            require($_SERVER['DOCUMENT_ROOT'] . "/pages/404.php");
        }
    }
    static function GetRoute($target, $file)
    {
        self::$routes[$target] = $file;
    }
}


