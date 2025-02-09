<?php
declare(strict_types=1);


namespace Randomserver\Router;

use Randomserver\Container\DIContainerInterface;
use Randomserver\Router\RouterInterface;
use Randomserver\Response\Response;

class Router implements RouterInterface{
   
    private static array $get=[];
    private static array $post=[];
    private static array $update=[];
    private static array $delete=[];

    public function __construct(
        private DIContainerInterface $container,
    ){}

    public function handle(){

        $reqMethod = $_SERVER["REQUEST_METHOD"];
 
        switch($reqMethod){
            case "GET":
                $this->matchRoute("get");
                break;
            case "POST":
                $this->matchRoute('post');
                break;
            case "UPDATE":
                $this->matchRoute("update");
                break;
            case "DELETE":
                $this->matchRoute("delete");
                break;
            default:
                Response::text("The method sent is not supported.");
                break;
        }
    }

    private function matchRoute(string $methodName){
        $routes = Router::$$methodName;
        $url = $_SERVER["REQUEST_URI"];

        foreach(array_keys($routes) as $route){
           
            $matches=[];
           
            preg_match($route,$url,$matches);
           
            if(count($matches)>0){
                
                $pairClassMethod = $routes[$route];

                $this->executeHandler($pairClassMethod[0],$pairClassMethod[1]);
                return;               
            }
        }

        Response::text("Not found",404);

    }

    private function executeHandler(string $className,string $methodName){

        $controller = $this->container->get($className);
        $controller->$methodName();
    }

    public static function get(string $regexp,string $className,string $methodName){
        Router::$get[$regexp]=[$className,$methodName];
    }
    public static function post(string $regexp,string $className,string $methodName){
        Router::$post[$regexp]=[$className,$methodName];
    }
    public static function update(string $regexp,string $className,string $methodName){
        Router::$update[$regexp]=[$className,$methodName];
    }
    public static function delete(string $regexp,string $className,string $methodName){
        Router::$delete[$regexp]=[$className,$methodName];
    }
}