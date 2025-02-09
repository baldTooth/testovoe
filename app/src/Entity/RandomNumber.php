<?php

namespace Randomserver\Entity;

/*** 
@method int getId()
@method int getNumber()
*/
class RandomNumber{

    public function __construct(
        private int $id = 0,
        private int $number = 0,
    )   
    {} 
    

    public function getId():int{
        return $this->id;
    }
    public function getNumber():int{
        return $this->number;
    }
}