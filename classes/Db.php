<?php

namespace classes;

use classes\Config;
use PDO;
use Exception;


class Db
{

  private static $instances = [];

  private $connection;

  private $config;

  private function __construct($db_config)
  {
    $this->config = $db_config;

    $this->connect();
  }



  private function __clone()
  {
  }

  public function __wakeup()
  {
  }

  public static function getInstance($info)
  {
    $subclass = static::class;

    $db_config = new Config($info);

    $db_config = $db_config->getConfig();

    if (self::$instances == null)
      self::$instances = new Db($db_config);

    return self::$instances;
  }

  public function close()
  {
    $this->connection->mysql_close();
    //self::$prp = null;
  }

  private function connect()
  {
    try {

      $this->connection = new PDO("mysql:dbname=" . $this->config['db']['dbname'] . ";host=" . $this->config['db']['host'] . ";charset=utf8", $this->config['db']['user'], $this->config['db']['password']);

      $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
    } catch (Exception $e) {
      die("**Error connection");
    }
  }

  public function query($sql)
  {
    //PR($sql);
    //die();
    $result = $this->connection->query($sql);
    if (!$result) {
      die("ошибка выполнения запроса: " . $this->connection->error);
    }
    return $result;
  }

  public function fetchAll($result)
  {
    $row = array();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }

  public function fetchrow($result)
  {
    return $result->fetch_accoc();
  }

  public function escapeString($string)
  {
    return $this->connection->real_escape_string($string);
  }
}
