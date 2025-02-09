<?php 
declare(strict_types=1);

namespace Randomserver;

use Randomserver\Container\DIContainer;
use Randomserver\Container\DIContainerInterface;
use Randomserver\Database\Interfaces\DBAdapterInterface;
use Randomserver\Database\PDOAdapter;
use Randomserver\Logger\LoggerInterface;
use Randomserver\Router\RouterInterface;
use Randomserver\Router\Router;
use Randomserver\Logger\SimpleLogger;
use Exception;


class App{

    public function run(){

        $logger = new SimpleLogger(getenv('logs_path'));

        try{

        
           $db = $this->configureDB();
           
           
           $container = $this->configureContainer();
           
           $container->registerResolved(LoggerInterface::class,$logger);
           $container->registerResolved(DBAdapterInterface::class,$db);

           $router = $this->configureRouter($container);


           $router->handle();
         
           
        }catch(Exception $exc){
            $logger->write("Fatal error",$exc);
        }


    }


    
    private function configureContainer():DIContainerInterface{
        
        $di = require_once  __DIR__."/di.php";
        
        return new DIContainer($di);
    }

    private function configureRouter(DIContainerInterface $container):RouterInterface{
        require  __DIR__."/routes.php";
    
        return new Router($container);
    }

    private function configureDB():DBAdapterInterface{
        $db_name = getenv("DB_NAME");
        $db_user = getenv("DB_USER");
        $db_password = getenv("DB_PASSWORD");
        $db_port = getenv("DB_PORT");
        $db_host = getenv('DB_HOST');

        $connectionString ="pgsql:host={$db_host};port={$db_port};dbname={$db_name}";
        
        $adapter = new PDOAdapter(
            $connectionString,
            $db_user,
            $db_password,
        );
        return $adapter;
    }
}