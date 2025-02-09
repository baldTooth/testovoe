<?php 

namespace Randomserver\Container;

interface DIContainerInterface{
    public function get(string $key):mixed;
    public function register(string $key,string $className):void;
    public function registerResolved(string $key,$value):void;
}