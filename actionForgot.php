<?php

include_once('autoloader.inc.php');
Session::init();
$fuser = new Auth();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
    
    $email = $fuser->test_input($_POST['femail']);

    $founded = $fuser->currentUser($email);

    if($founded != null){
        $token = uniqid();
        $token = str_shuffle($token);

        $fuser->forgotPass($token,$email);


        try{
           
            $mail->isSMTP();
            $mail->Host = getenv('M_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = getenv('M_KEY');
            $mail->Password = getenv('M_PASS');
            $mail->SMTPSecure= PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom(getenv('M_KEY'),'4Meat Lovers');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject ='Reset Password';
            $mail->Body = '<h3>Click the link below to reset your password.<br><a
            href="http://meat-lovers.herokuapp.com/reset-pass.php?email='.$email.'
            &token='.$token.'">http://meat-lovers.herokuapp.com/reset-pass.php?email='.$email.'
            &token='.$token.'</a><br>Regards,<br>4Meat Lovers</h3>';

            $mail->send();
            echo $fuser->alert('purple','We have sent the reset link to your e-mail ID, please check
            your e-mail adress.');
        }
        catch(Exception $e){
            echo $fuser->alert('red','Something went wrong.Please try again later.');
            
        }
    }else{
        echo $fuser->alert('red','This e-mail is not registered.');
    }
}



?>