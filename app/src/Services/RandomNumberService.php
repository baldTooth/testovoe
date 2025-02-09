<?php 
declare(strict_types=1);

namespace Randomserver\Services;

use Randomserver\Entity\RandomNumber;
use Randomserver\Repositories\Interfaces\RandomNumberRepositoryInterface;
use Randomserver\Services\Interfaces\RandomNumberServiceInterface;

class RandomNumberService implements RandomNumberServiceInterface{

    public function __construct(
        private RandomNumberRepositoryInterface $randomNumberRepository,
    ){

    }
    public function create():int{
        $randomNumber = $this->generateRandomInt();
        $id = $this->randomNumberRepository->insert($randomNumber);
        return $id;
    }

    public function generateRandomInt(): int
    {
        return mt_rand();
    }
    public function getById(int $id): RandomNumber|null
    {   
        
        return $this->randomNumberRepository->selectById($id);   
    }
    
}