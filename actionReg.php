<?php 

include_once('autoloader.inc.php');
Session::init();
$user = new Auth();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
    
    $username = $user->test_input($_POST['username']);
    $email = $user->test_input($_POST['email']);
    $password = $user->test_input($_POST['password']);
    $cpassword = $user->test_input($_POST['conf_password']);

    $hpass = password_hash($password,PASSWORD_DEFAULT);

    
    
    if(empty($username) || empty($email) || empty($password) || empty($cpassword)){
        echo $user->alert('red','*Please fill all the fields.');
        
    }
    elseif(strlen($username) < 3){
         echo $user->alert('red','*Username must be at least 3 characters long.');
    }
    elseif(preg_match('/[^a-z0-9_-]+/i',$username)){
        echo $user->alert('red','*Username can contain only alpha numeric,dash and underscore character.');
       
    }
    elseif(strlen($password) < 8){
            echo $user->alert('red','*Password must be at least 8 characters long.');
           
    }
    elseif($password !== $cpassword){
        echo $user->alert('red','*Passwords do not match.');
        
    }
    elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        echo $user->alert('red','*E-mail address not valid.');
    }
    elseif($user->alreadyExist($email,'email')){
        echo $user->alert('red','*This e-mail adress is already registered.');
    }elseif($user->alreadyExist($username,'username')){
        echo $user->alert('red','*This username is already registered');
    }
    else{
        if($user->register($username,$email,$hpass)){
            echo 'register';
            Session::set('user',$email);
            Session::set('uname',$username);
            Session::set('login',true);
            
        }else{
            echo $user->alert('red','*Something went wrong.Please try again later.');
        }
    }
}
?>