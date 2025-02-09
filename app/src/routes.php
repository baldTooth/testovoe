<?php 
namespace Randomserver;

use Randomserver\Controllers\RandomNumber\RandomNumberControllerInterface;
use Randomserver\Router\Router;

//Router:httpMethod(regex,interfaceController,methodName);


Router::get("/^\/random\/?$/",RandomNumberControllerInterface::class,'generate');
Router::get("/^\/get\/[\d]+\/?$/",RandomNumberControllerInterface::class,"getById");