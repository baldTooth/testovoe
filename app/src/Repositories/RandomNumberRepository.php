<?php 

namespace Randomserver\Repositories;

use Randomserver\Repositories\Interfaces\RandomNumberRepositoryInterface;
use Randomserver\Entity\RandomNumber;
use Randomserver\Database\Interfaces\DBAdapter;
use Randomserver\Database\Interfaces\DBAdapterInterface;

class RandomNumberRepository implements RandomNumberRepositoryInterface{
    
    public function __construct(
        private DBAdapterInterface $db
    )
    {}

    public function insert(int $number):int{
        $this->db->query(
            "
                insert into generated_numbers
                (number)
                values(?)
            ",[$number]
        );
        
        return $this->db->lastInsertedId();
    }

    public function selectById(int $id):RandomNumber|null{
        $this->db->query(
            "
                select id,number 
                from generated_numbers
                where id=?
         
            ",[$id]
        );
        $row = $this->db->fetch();
        
        if($row===null||$row===false){
            return null;
        }

        $rn = new RandomNumber($row["id"],$row["number"]);


        return $rn;
    }
}