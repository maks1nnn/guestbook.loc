<?php

namespace models;

use vendor\Config;
use vendor\InsertQueryBuilder;

class InsertUserNameInDb
{

    private $query;
    private $tableName;
    private $param;

    public function __construct($hashedPassword)
    {
        $tableName = new Config('../config/dbinfo.ini');


        $this->tableName = $tableName->get('tableNameUsers');
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
