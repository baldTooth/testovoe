<?php 

namespace Randomserver\Services\Interfaces;
use Randomserver\Entity\RandomNumber;


interface RandomNumberServiceInterface{
    public function create():int;
    public function getById(int $id):RandomNumber|null;
    public function generateRandomInt():int;
}