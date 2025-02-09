<?php 

namespace Randomserver\Database;

use PDO;
use PDOStatement;
use Randomserver\Database\Interfaces\DBAdapterInterface;

class PDOAdapter implements DBAdapterInterface{
    
    private PDO $pdo;
    private PDOStatement $stmt;

    public function __construct(
        string $connectionSetring,
        string $user,
        string $password        
    ){
        $this->pdo = new PDO($connectionSetring,$user,$password,[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES=>false,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
        ]);
    }

    
    public function query(string $sql,array $params):array|null{
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);

        return null;
    }
 
    public function lastInsertedId():int{

        return (int)$this->pdo->lastInsertId();
 
    }
    public function fetch(){
        return $this->stmt->fetch();
    }
    public function fetchAll(){

        return $this->stmt->fetchAll();
 
   }
}