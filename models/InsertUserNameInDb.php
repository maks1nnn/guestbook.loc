<?php

namespace models;

use vendor\InsertQueryBuilder;

class InsertUserNameInDb
{

    private $query;
    private $tableName;
    private $param;

    public function __construct($hashedPassword)
    {

        $this->tableName = 'Users';
        $query = new InsertQueryBuilder();
        $this->param = ['login' => $_POST['userName'], 'email' => $_POST['email'], 'pass' =>  $hashedPassword];
        $this->query = $query->into($this->tableName)->values($this->param);
    }

    public function insert($db)
    {
        $db->query($this->query->build());
    unset($query);
    return true;
    }
}
