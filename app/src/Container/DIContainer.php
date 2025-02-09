<?php 
declare(strict_types=1);

namespace Randomserver\Container;

use Randomserver\Container\Exceptions\DINotFoundDefinitionsException;

// WARNING, not check circular resolving arguments
class DIContainer implements DIContainerInterface{
    
    private array $definitions;

    private array $resolved = [];

    public function __construct(
        array $definitions,
    ){
        $this->definitions=$definitions;
    }

    public function registerResolved(string $key,$value):void{
        $this->resolved[$key]=$value;
    }

    public function register(string $key,string $className):void{
        $this->definitions[$key]=$className;
    }

    public function get(string $key):mixed{
        if(isset($this->resolved[$key])){
            return $this->resolved[$key];
        }

        if(!isset($this->definitions[$key])){
            throw new DINotFoundDefinitionsException($key);
        }
        
        $value = $this->resolve($key);
        return $value;
    }

    private function resolve(string $key):mixed{
        
        if(!isset($this->definitions[$key])){
            throw new DINotFoundDefinitionsException($key);
        }

        if(isset($this->resolved[$key])){
            $value = $this->resolved[$key];
            return $value; 
        }

        $definition = $this->definitions[$key];
        $reflector = new \ReflectionClass($definition);

        $constructorReflector = $reflector->getConstructor();

        if(empty($constructorReflector)){
            
            $value = new $definition;
            $this->resolved[$key]=$value;
            return $value;
        }

        $argumentsConstructor = $constructorReflector->getParameters();

        if(empty($argumentsConstructor)){
            $value = new $definition;
            $this->resolved[$key]=$value;
            return $value;
        }

        $args = [];

        foreach($argumentsConstructor as $arg){
            
            $argType =  $arg->getType()->getName();
            $argName = $arg->getName();
            $argValue = null;

            if($argType==="string"||$argType==="int"){
                
                
                if(isset($this->resolved[$argName])){
                    $argValue = $this->resolved[$argName];
                }else{
                    throw new DINotFoundDefinitionsException($argName);
                }

            }else{
                $argValue = $this->get($argType);
            }

            $args[$argName] = $argValue;
        
        }
        

        $value = new $definition(...$args);

        return  $value;


    }
}





