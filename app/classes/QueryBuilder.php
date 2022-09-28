<?php

namespace App\clasess\builder;

use PDO;
use Aura\SqlQuery\QueryFactory;



class QueryBuilder
{
    private $pdo;
    private $queryFactory;
    public function __construct()
    {
        $this->queryFactory = new QueryFactory('mysql');
        $this->pdo = new PDO('mysql:host=localhost;dbname=simple;charset=utf8', "root", "");
    }
    public function getAll($table){
        $select = $this->queryFactory->newSelect();
        $select->from($table)->cols(['*']);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllLimit($table, $limit, $offset, $id){
        $select = $this->queryFactory->newSelect();
        $select->from($table)->cols(['*'])->where("user_id = :id")->bindValue('id', $id)->limit($limit)->offset($offset);



        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCount($table){
        $select = $this->queryFactory->newSelect();
        $select->from($table)->cols(['COUNT(*)']);

        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($table, $id){
        $delete = $this->queryFactory->newDelete();

        $delete->from($table)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());

    }
    public function getOneById($table, $id){
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])->from($table)->where('id = :id')->bindValue('id', $id);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function add($table, $data){
        $insert = $this->queryFactory->newInsert();

        $insert->into($table)->cols($data);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
        $name = $insert->getLastInsertIdName('id');
        return $this->pdo->lastInsertId($name);
    }
    public function update($table, $id, $data){
        $update = $this->queryFactory->newUpdate();

        $update->table($table)->cols($data)->where("id = :id")->bindValue('id', $id );
        $sth = $this->pdo->prepare($update->getStatement());


        $sth->execute($update->getBindValues());
    }

}