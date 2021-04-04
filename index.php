<?php
include_once('autoloader.inc.php');
Session::init();
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
</head>
<body>
<header>
    <div class="container">
        <nav class="nav">
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
            </div>
            <a href="index.php" class="logo"><img src="images/logo1.png" alt="logo"></a>
            <ul class="nav-list">
                
                <li class="nav-item">
                    <a href="index.php" class="nav-link active"><i class="fas fa-home"></i> Home</a>
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
                <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) :?>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> Logout</a>
                </li>
                <?php else: ?>

                <li class="nav-item">
                    <a href="login.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Login</a>
                </li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>
<!--End header-->


<section class="hero" id="hero">
    <div class="container">
        <h2 class="sub-headline">
            <span class="first-letter">W</span>elcome
        </h2>
        <h1 class="headline">Meat Lovers</h1>
        <div class="headline-description">
            <div class="separator">
                <div class="line line-left"></div>
                <div class="asterisk">
                    <i class="fas fa-asterisk"></i>
                </div>
                <div class="line line-right"></div>
            </div>
            <div class="single-animation">
                <h5>Ready to start cooking?</h5>
                
            </div>
        </div>
    </div>
</section>
<!--End hero section-->
<section class="discover">
    <div class="container">
        <div class="exp-info">
            <div class="exp-description padding-right animate-left">
                <div class="global-headline">
                    <h2 class="sub-headline">
                        <span class="first-letter">D</span>iscover
                    </h2>
                    <h1 class="headline headline-dark">Cooking Experiences</h1>
                    <div class="asterisk">
                        <i class="fas fa-asterisk"></i>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ipsam odio omnis alias debitis dicta aut est consectetur delectus ex,
                     temporibus quae. Laborum alias saepe neque odit incidunt, rem culpa!
                </p>
                <a href="sugest.php" class="btn body-btn">Explore</a>
            </div>
            <div class="exp-desc-img animate-right">
                <img src="images/exp-img.jpg" alt="steak">
            </div>
        </div>
    </div>
</section>
<!--End discover section-->
<section class="tasty between">
    <div class="container">
        <div class="global-headline">
            <div class="animate-top">
                <h2 class="sub-headline">
                    <span class="first-letter">T</span>asteful
                </h2>
            </div>
             <div class="animate-bottom">
                <h1 class="headline">Recipes</h1>
                <a href="recipe.php" class="btn light-btn">Explore</a>
             </div>      
                    
                   
        </div>
    </div>
</section>
 <!--End tasty section-->
 <section class="discover-variety">
     <div class="container">
         <div class="exp-info">
             <div class="image-group padding-right animate-left">
                 <img src="images/beef.jpg" alt="beef steak">
                 <img src="images/lamb.jpg" alt="lamb steak">
                 <img src="images/pork.jpg" alt="pork steak">
                 <img src="images/chicken.jpg" alt="chicken meat">
             </div>
             <div class="exp-description animate-right">
                <div class="global-headline">
                    <h2 class="sub-headline">
                        <span class="first-letter">D</span>iscover
                    </h2>
                    <h1 class="headline headline-dark">Dishes</h1>
                    <div class="asterisk">
                        <i class="fas fa-asterisk"></i>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea nemo, 
                    quisquam aliquid nihil sequi, soluta recusandae ipsum dolores nesciunt iure officia omnis corrupti obcaecati deserunt vitae, dolor asperiores blanditiis ab optio eligendi beatae. 
                    Illo quibusdam similique est perspiciatis consectetur fuga.
                </p>
                <a href="recipe.php" class="btn body-btn">Explore</a>
             </div>
         </div>
     </div>
 </section>
 <!--End discover-variety section-->
 <section class="spices-blend between">
     <div class="container">
        <div class="global-headline">
            <div class="animate-top">
                <h2 class="sub-headline">
                    <span class="first-letter">B</span>lending
                </h2>
            </div>
             <div class="animate-bottom">
                <h1 class="headline">Spices</h1>
             </div>      
                    
        </div>
     </div>
 </section> 
 <!--End spices-blend section-->
 <section class="delightful-tips">
 <div class="container">
        <div class="exp-info">
            <div class="exp-description padding-right animate-left">
                <div class="global-headline">
                    <h2 class="sub-headline">
                        <span class="first-letter">D</span>elightful
                    </h2>
                    <h1 class="headline headline-dark">Tips</h1>
                    <div class="asterisk">
                        <i class="fas fa-asterisk"></i>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ipsam odio omnis alias debitis dicta aut est consectetur delectus ex,
                     temporibus quae. Laborum alias saepe neque odit incidunt, rem culpa!
                </p>
                <a href="facts.php" class="btn body-btn">Explore</a>
            </div>
            <div class="image-group">
                <img class="animate-top" src="images/cook1.jpg" alt="cooking tip">
                <img  class="animate-bottom" src="images/cook2.jpg" alt="girl cooking">
            </div>
        </div>
    </div>
 </section>
 <!--End delightful-tips section-->
 <footer>
     <div class="container">
         <div class="back-to-top">
             <a href="#hero"><i class="fas fa-chevron-up"></i></a>
         </div>
         <div class="footer-content">
             <div class="footer-content-about animate-top">
                 <h4>4Meat Lovers</h4>
                 <div class="asterisk">
                     <i class="fas fa-asterisk"></i>
                 </div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatum sed odio tempora, delectus, impedit enim dignissimos atque eos expedita consequuntur in voluptatem adipisci pariatur. Voluptates omnis maiores 
                    nostrum ducimus nisi molestiae aperiam. Neque, itaque maxime?</p>
             </div>
             <div class="footer-content-divider animate-bottom">
                 <div class="social-media">
                     <h4>Follow us</h4>
                     <ul class="social-icons">
                         <li>
                             <a href="#"><i class="fab fa-twitter"></i></a>
                         </li>
                         <li>
                             <a href="#"><i class="fab fa-facebook-square"></i></a>
                         </li>
                         <li>
                             <a href="#"><i class="fab fa-pinterest"></i></a>
                         </li>
                         <li>
                             <a href="#"><i class="fab fa-linkedin-in"></i></a>
                         </li>
                         <li>
                             <a href="#"><i class="fab fa-instagram"></i></a>
                         </li>
                     </ul>
                 </div>
                 <div class="newsletter-container">
                     <h4>Newsletter</h4>
                     <form action="" class="newsletter-form">
                         <input type="text" class="newsletter-input" placeholder="Your email">
                         <button class="newsletter-btn" type="submit">
                             <i class="fas fa-envelope"></i>
                         </button>
                     </form>
                 </div>
             </div>

         </div>
     </div>
 </footer>     
           
<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>