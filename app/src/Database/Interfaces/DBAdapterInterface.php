<?php 

namespace Randomserver\Database\Interfaces;

interface DBAdapterInterface{
    public function query(string $sql,array $params):array|null;
    public function fetch();
    public function fetchAll();
    public function lastInsertedId():int;
}