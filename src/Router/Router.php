<?php
namespace Scandioop\Router;

class Router
{
    public static function handle($method = 'GET', $path = '/Scandioop', $filename = ''){
        $currentUri = $_SERVER['REQUEST_URI'];
        if ($_SERVER['REQUEST_METHOD'] != $method){
            return false;
        }
        $root = '/Scandioop';
        $pattern = '#^'.$root.$path.'$#siD';
        if(preg_match($pattern, $currentUri)){
            require_once $filename;
            exit();
        }  
        return false;
    }
     public static function defaultRoute()
    {
        require_once __DIR__ . '/../Views/404error.php';
        exit();
    }

}