<?php 

namespace Randomserver\Container\Exceptions;

use Throwable;
use Exception;

class DINotFoundDefinitionsException extends Exception{
    public function __construct(string $interfaceName,int $code=0, Throwable $previus=null){
        parent::__construct("Not found definitions for key = ".$interfaceName,$code,$previus);
    }
}