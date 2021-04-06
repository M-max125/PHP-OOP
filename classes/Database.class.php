<?php 

require_once './vendor/autoload.php';
use SecureEnvPHP\SecureEnvPHP;
(new SecureEnvPHP())->parse('./clock/.env.enc', '.env.key');

class Database{
    
    private $host;
    private $dbname;
    private $dbuser;
    private $dbpass;
    
    public $conn;
    
    public function __construct(){
       

        //prod mode
        $this->host = getenv('DB_HOST');
        $this->dbname = getenv('DB_NAME');
        $this->dbuser = getenv('DB_USER');
        $this->dbpass = getenv('DB_PASS');
        
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