<?php 

namespace Randomserver\Router;

interface RouterInterface{
    public function handle();
    public static function get(string $regexp,string $className,string $methodName);
    public static function post(string $regexp,string $className,string $methodName);
    public static function update(string $regexp,string $className,string $methodName);
    public static function delete(string $regexp,string $className,string $methodName);
}