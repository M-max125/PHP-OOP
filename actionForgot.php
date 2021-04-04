<?php

include_once('autoloader.inc.php');
Session::init();
$fuser = new Auth();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
    
    $email = $fuser->test_input($_POST['femail']);

    $founded = $fuser->currentUser($email);

    if($founded != null){
        $token = uniqid();
        $token = str_shuffle($token);

        $fuser->forgotPass($token,$email);
    }
}



?>