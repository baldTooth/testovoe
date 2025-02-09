<?php 
namespace Randomserver\Support;

class URLHelper{
    public static function getLastParameter():int|string{
        $uri = $_SERVER["REQUEST_URI"];
        $arr = explode("/",$uri);
        return end($arr);
    }
}