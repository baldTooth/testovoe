<?php 

namespace Randomserver\Logger;
use Exception;

interface LoggerInterface{
    public function write(string $message="",Exception $exc=null);
}