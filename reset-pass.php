<?php
include_once('autoloader.inc.php');
$ruser = new Auth();

$msg = '';

if(isset($_GET['email']) && isset($_GET['token'])){
    $email = $ruser->test_input($_GET['email']);
    $token = $ruser->test_input($_GET['token']);

    $auth_user = $ruser->resetPass($email,$token);

    if($auth_user != null){
        if(isset($_POST['reset'])){
            $newpass = $_POST['rpass'];
            $cnewpass = $_POST['rpassword'];

            $hnewpass = password_hash($newpass,PASSWORD_DEFAULT);

            if($newpass == $cnewpass){
                $ruser->updatePass($hnewpass,$email);
                $msg = 'Your password has been reset.<br> <a href = "login.php">Login here</a>';
            }else{
                $msg = 'Passwords do not match.';
            }
        }
    }else{
        header("Location:login.php");
        exit();
    }
}else{
    header("Location:login.php");
        exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4Meat Lovers</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon-io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-io/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"  />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
<div class="f-container">
        <div class="forms-container">
            <div class="signin-signup">
                
                <form action="#" class="sign-in-form" id="reset-form" method="post">
                    <h2 class="f-title">Reset Password</h2>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="rpass" id="rpass" placeholder="New password" class="pass" required >
                        <i class="fas fa-eye show"></i>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="rpassword" id="rpassword" placeholder="Confirm new password"  class="pass" required >
                        <i class="fas fa-eye show"></i>
                    </div>
                    
                    
                    <input type="submit" name="reset" value="Reset" class="f-btn solid" id="reset-btn">
                    <p class="p-red"><?= $msg;?></p>
                </form>
                 
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="panel-content">
                    <h3>4Meat Lovers</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aspernatur, vero facilis fugiat itaque ab expedita 
                        fugit perspiciatis dolores tempore.
                    </p>
                    
                </div>
                <img src="images/undraw_eating_together_tjhx.svg" alt="man cook" class="panel-img">
            </div>

            
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/forms.js"></script> 
    <script>
        //Show pass when eye icon clicked
        const pass_field = document.getElementsByClassName('pass');
        const show_pass = document.getElementsByClassName('show');



        for (i = 0; i < show_pass.length; i++) {
            show_pass[i].addEventListener('click', () => {
                for (i = 0; i < pass_field.length; i++) {
                    if (pass_field[i].type === "password") {
                        pass_field[i].type = "text";
                        show_pass[i].style.color = "#3C0B9C";
                    } else {
                        pass_field[i].type = "password";
                        show_pass[i].style.color = "var(--body-font-color)";
                    }
                }
            });
        }

    </script>
</body>
</html>