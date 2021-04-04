<?php 

class Database{
    private $dsn = "mysql:host=localhost;dbname=db_food_app";
    private $dbuser = "root";
    private $dbpass = "";

    public $conn;

    public function __construct(){
        try{
            $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
            
        }
        catch(PDOException $e){
            echo 'Error : ' .$e->getMessage();
        }

        
    }
  

   
    
   
}


?>