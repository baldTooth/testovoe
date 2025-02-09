<?php

namespace Randomserver\Repositories\Interfaces;
use Randomserver\Entity\RandomNumber;


interface RandomNumberRepositoryInterface{
    public function insert(int $number):int;
    public function selectById(int $id):RandomNumber|null;
}