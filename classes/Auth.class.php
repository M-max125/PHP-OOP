<?php 

include_once('Database.class.php');
include_once('Session.class.php');

class Auth extends Database{

      //Validate input
      public function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    
    //Displaying error or success messages
    public function alert($color,$message){
        return '<p class="p-'.$color.'">'.$message.'</p>';
    }

    
    //Check if email or username already exists
    
    public function alreadyExist($data,$type){
        $sql = "SELECT $type FROM users WHERE $type = :$type";
        $query = $this->conn->prepare($sql);
        $query->bindParam(":$type",$data);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

   
    
    
    //Register new user

    public function register($username,$email,$password){
        $sql = "INSERT INTO users (username,email,password) VALUES (:username,:email,:pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":pass",$password);
        $stmt->execute();
        return true;
    }

    //Existing user
    public function login($email){
        $sql = "SELECT email,password,username FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    // Get user's details
    public function currentUser($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
    //Get username
    public function get_uname($id){
        $sql = "SELECT username FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Forgot password

    public function forgotPass($token,$email){
        $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":token",$token);
        $stmt->bindParam(":email",$email);
        $stmt->execute();

        return true;
    }

    //Insert recipe

    public function addRecipe($uid,$title,$instructions,$ingredients,$photo){
        $sql = "INSERT INTO recipes (uid,title,instructions,ingredients,photo) VALUES (:uid,:title,:instructions,:ingredients,:photo)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":uid",$uid);
        $stmt->bindParam(":title",$title);
        $stmt->bindParam(":instructions",$instructions);
        $stmt->bindParam(":ingredients",$ingredients);
        $stmt->bindParam(":photo",$photo);
        $stmt->execute();
        return true;
    }
    //Get recipes

    public function get_recipes(){
        $sql = "SELECT * FROM recipes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    //Reset password

    public function resetPass($email,$token){
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("email",$email);
        $stmt->bindParam("token",$token);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
        
    }
    //Update new password
    public function updatePass($pass,$email){
        $sql = "UPDATE users SET token = '',password = :pass WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("pass",$pass);
        $stmt->bindParam("email",$email);
        $stmt->execute();

        return true;
    }

   
     
   
}

?>