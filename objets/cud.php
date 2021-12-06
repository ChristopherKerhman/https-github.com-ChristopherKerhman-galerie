<?php
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
  function __destruct() {
    
  }
}
