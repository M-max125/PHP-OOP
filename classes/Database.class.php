<?php 

class Database{
    
    private $host;
    private $dbname;
    private $dbuser;
    private $dbpass;
    
    public $conn;
    
    public function __construct(){
        
        $this->host = 'localhost';
        $this->dbname = 'db_food_app';
        $this->dbuser = 'root';
        $this->dbpass = '';
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
        
        try{
            $this->conn = new PDO($dsn,$this->dbuser,$this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
            
        }
        catch(PDOException $e){
            echo 'Error : ' .$e->getMessage();
        }

        
    }
  

   
    
   
}


?>