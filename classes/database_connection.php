<?php


class Database_Connection{
  
    public $conn;
    private $username;
    private $password;
    private $dsn;
   

    public function connect() {
        $this->username="root";
        $this->password="";
      $this->dsn="mysql:host=localhost;dbname=chat_system;charset=utf8mb4";

// Create connection
$this->conn = new PDO($this->dsn,$this->username,$this->password);
return $this->conn;
  
}
}


?>
