<?php
include_once('autoloader.inc.php');
Session::init();
$user = new Auth();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){

    $email = $user->test_input($_POST['email']);
    $pass = $user->test_input($_POST['password']);

    $logUser = $user->login($email);
    

    if($logUser != null){
        if(password_verify($pass,$logUser['password'])){
            
            if(!empty($_POST['remember'])){
                setcookie("email",$email,time()+(30*24*60*60),'/');
                 setcookie("password",$pass,time()+(30*24*60*60),'/');
            }
            else{
                setcookie("email","",1,'/');
                 setcookie("password","",1,'/');
            }
            echo 'login';
            Session::set('login',true);
            Session::set('user',$email);
            Session::set('uname',$logUser['username']);
          
        }
        else{
            echo $user->alert('red','*Password is incorrect');
        }
    }else{
        echo $user->alert('red','*User not found.Please provide the correct e-mail address.');
    }
}

?>