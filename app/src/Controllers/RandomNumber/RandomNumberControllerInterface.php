<?php 
namespace Randomserver\Controllers\RandomNumber;

interface RandomNumberControllerInterface{
    public function generate();
    public function getById();
}