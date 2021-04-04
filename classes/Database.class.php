<?php 

class Database{
    
    private $host;
    private $dbname;
    private $dbuser;
    private $dbpass;
    
    public $conn;
    
    public function __construct(){
        //dev mode
        // $this->host = 'localhost';
        // $this->dbname = 'db_food_app';
        // $this->dbuser = 'root';
        // $this->dbpass = '';

        //prod mode
        $this->host = 'eu-cdbr-west-01.cleardb.com';
        $this->dbname = 'heroku_4576f989dde6a1e';
        $this->dbuser = 'bc5109bae534fb';
        $this->dbpass = '4efea717';
        
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