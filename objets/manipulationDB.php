<?php
class ParamDB {
  protected $serverName = "localhost";
  protected $userName = "Lacerta_agilis";
  protected $password = "vZaYqpkBh6srRCVO";
  protected $dbName = "Lacerta_agilis";
}
class readDB extends ParamDB {
  private $sql;
  private $param;
  public function __construct($sql, $param) {
    $this->sql = $sql;
    $this->param = $param;
  }
  public function read() {

    try {
      $conn = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->userName, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //$data = $conn->prepare($this->sql);
    } catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
    }
    $data = $conn->prepare($this->sql);
    foreach ($this->param as $key) {
      $data->bindParam($key['prep'],$key['variable']);
    }
    $data->execute();
    $data->setFetchMode(PDO::FETCH_ASSOC);
    $dataTraiter = $data->fetchAll();
    return $dataTraiter;
  }
  function __destruct(){}
}
class CurDB extends ParamDB {
  private $sql;
  private $param;
  public function __construct($sql, $param) {
    $this->sql = $sql;
    $this->param = $param;
  }
  public function actionDB() {
    try {
      $conn = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->userName, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
    }
    $data = $conn->prepare($this->sql);
    foreach ($this->param as $key) {
      $data->bindParam($key['prep'],$key['variable']);
    }
    $data->execute();
  }
}
