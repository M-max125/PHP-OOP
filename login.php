<?php 
include_once('autoloader.inc.php');

Session::init();
Session::checkLogin();


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
    <link rel="manifest" href="favicon-io/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"  />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<header style="z-index: 20">
<div class="container">
        <nav class="nav">
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>
            <a href="index.php" class="logo"><img src="images/logo1.png" alt="logo"></a>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="recipe.php" class="nav-link"><i class="fas fa-utensils"></i> Yummy recipes</a>
                </li>
                <li class="nav-item">
                    <a href="facts.php" class="nav-link"><i class="far fa-newspaper"></i> Food Facts</a>
                </li>
                <li class="nav-item">
                    <a href="sugest.php" class="nav-link"><i class="fas fa-edit"></i> Suggestions</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link active"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
              
            </ul>
        </nav>
    </div>
</header>
<!--End header-->




    <div class="f-container">
        <div class="forms-container">
            <div class="signin-signup">
                <!--Sign in form-->
                <form action="actionLog.php" class="sign-in-form" id="login-form" method="post">
                    <h2 class="f-title">Sign In</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="E-mail" required value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];}?>">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Password"  class="pass" required value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>">
                        <i class="fas fa-eye show"></i>
                    </div>
                    <div class="check-box">
                        <div class="field-check">
                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email'])) {?> checked <?php } ?>>
                            <label for="customCheck" class="custom-control-label">Remember Me</label>
                        </div>
                        <div class="forgot-pass">
                                    <a href="#" id="forgot-link">Forgot Password ?</a>
                        </div>
                    </div>
                    <div id="logAlert"></div>
                    <input type="submit" value="Login" class="f-btn solid" id="login-btn">
                    <p class="social-text">Or sign in with your Google account</p>
                    <div class="google-media">
                         <button type="button" class="g-btn">
                             <div class="g-social">
                             <i class="fab fa-google"></i>
                             </div>
                             
                             Sign in with Google</button>
                    </div>
                </form>
                 <!--Sign in form end-->
                
                 <!--Forgot password form-->
                        <form action="actionForgot.php" class="sign-in-form" id="forgot-form" method="post">
                            <h2 class="f-title">Reset password</h2>
                            <p>To reset your pasword enter the registered email adress and we will send you the reset intructions on your email!</p>
                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="femail" id="femail" placeholder="E-mail" required>
                            </div>
                            <div id="forgotAlert"></div>
                            <input type="submit" value="Reset" class="f-btn solid" id="forgot-btn">
                            <div class="forgot-pass">
                                        <a href="" id="back-link">Back</a>
                            </div>
                    
                    
                        </form>
                   
                 <!--Forgot password form end-->


                  
                 <!--Sign up form-->
                <form action="actionReg.php" class="sign-up-form" id="register-form" method="post">
                    <h2 class="f-title">Sign Up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username"  placeholder="Username" required minlength="3">
                        
                    </div>
                    <p id="unameError" class="p-red"></p>
                    
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="reg-email"  placeholder="E-mail" required >
                    </div>
                    <p id="mailError" class="p-red"></p>
                    
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="reg-password"placeholder="Password" class="pass" required minlength="8">
                        <i class="fas fa-eye show"></i>
                    </div>
                    
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="conf_password" id="conf-password"  placeholder="Confirm Password" class="pass" required minlength="8">
                        <i class="fas fa-eye show"></i>
                    </div>
                    <p id="passError" class="p-red"></p>
                    <div id="regAlert"></div>
                   
                    <input type="submit" name="register" id="register-btn" value="Sign up" class="f-btn solid">
                   
                    <p class="social-text">Or sign up with your Google account</p>
                    <div class="google-media">
                         <button type="button" class="g-btn">
                             <div class="g-social">
                             <i class="fab fa-google"></i>
                             </div>
                             
                             Sign up with Google</button>
                    </div>
                </form>
                 <!--Sign up form end-->
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="panel-content">
                    <h3>New here?</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aspernatur, vero facilis fugiat itaque ab expedita 
                        fugit perspiciatis dolores tempore.
                    </p>
                    <button class="f-btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="images/undraw_cooking_lyxy.svg" alt="man cook" class="panel-img">
            </div>

            <div class="panel right-panel">
                <div class="panel-content">
                    <h3>One of us?</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint aspernatur, vero facilis fugiat itaque ab expedita 
                        fugit perspiciatis dolores tempore.
                    </p>
                    <button class="f-btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="images/undraw_Chef_cu0r.svg" alt="chef" class="panel-img">
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="js/main.js"></script>  
    <script src="js/login.js"></script> 
    <script src="js/forms.js"></script> 
</body>
</html>