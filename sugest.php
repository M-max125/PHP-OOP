<?php
include_once('autoloader.inc.php');
Session::init();
Session::checkSession();

$cuser = new Auth();
$cemail =  $_SESSION['user'];
$data = $cuser->currentUser($cemail);
$cname = $data['username'];






 



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
    <link rel="stylesheet" href="css/sugest.css">
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
                    <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="recipe.php" class="nav-link"><i class="fas fa-utensils"></i> Yummy recipes</a>
                </li>
                <li class="nav-item">
                    <a href="facts.php" class="nav-link"><i class="far fa-newspaper"></i> Food Facts</a>
                </li>
                <li class="nav-item">
                    <a href="sugest.php" class="nav-link active"><i class="fas fa-edit"></i> Suggestions</a>
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

<section id="add-on">

</section>
<!--End add-on section-->

<section class="discover">
    <div class="container">
        
        <div class="global-headline">
            <h3 class="r-share">Would you like to share your own recipes? </h3>
        </div>
            <p class="add-on-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ipsam odio omnis alias debitis dicta aut est consectetur delectus ex,
                     temporibus quae. Laborum alias saepe neque odit incidunt, rem culpa!
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, maiores.
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, aspernatur.
            </p>
            
            
            <div class="btn-wrap"><button name="add_on" class="btn var-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add recipe</button></div>

            
            <!--Modal form -->
    <div id="id01" class="modal">
  
        <form class="modal-content animate" id="add-recipe" action="" method="post" enctype="multipart/form-data">
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="images/image-form.jpeg" alt="food avatar" class="avatar">
            </div>

            <div class="cont">
            <label for="title"><b>Title</b></label>
            <input type="text" placeholder="Write recipe title" name="title" >

            <label for="instruction"><b>Instructions</b></label>
            <textarea name="instruction" id="instruction"  placeholder="Write instructions" ></textarea>

            <label for="ing"><b>Ingredients / quantity</b></label>
            <textarea name="ing" id="ing"  placeholder="Write ingredients and quantities" ></textarea>

            <label class="mb" for="file"><b>Add photo</b></label>
            <input type="file"  name="file"  class="file">

            <div id="addAlert"></div>
                
            <button type="submit" class="btn var-btn" name="add-btn" id="add-btn">Post recipe</button>
            
            </div>

            <div class="cont" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn cancelbtn">Cancel</button>
            
            </div>
        </form>
    </div>
   <!--Modal form end-->
   <div class="global-headline">
            <h3 class="r-share">Here are some tasty suggestions from our users </h3>
        </div>
   <?php
   $recipe = $cuser->get_recipes();

   for($i=0;$i<count($recipe);$i++){
            echo '<div class="exp-info margin--bottom">';
            echo '<div class="exp-description padding-right animate-left">';
            echo '<h2 class="dish-title">'. $recipe[$i]['title'].'</h2>';
            echo '<p>'.$recipe[$i]['instructions'].'</p>';
            echo '<h6 class="ing">'."Ingredients".'</h6>';
            echo '<p>'.$recipe[$i]['ingredients'].'</p>';
            $uid = $recipe[$i]['uid'];
            $uname =$cuser->get_uname($uid);
            $date = $recipe[$i]['created_at'];
            $created_at = date('Y-m-d',strtotime($date));
            echo '<small class="feed-date"><em>Posted on '.$created_at.' by '.$uname['username'].'</em></small>';
            echo '</div>';
            echo '<div class="exp-desc-img animate-right">';
            echo '<img  src = "uploads/'.$recipe[$i]['photo'].'" >';
            echo '</div>';
            echo '</div>';
            echo '<hr>';
            
    
            
       
    }
   
   
   ?>
    </div>
</section>
<!--Footer-->
<footer>
     <div class="container">
         <div class="back-to-top">
             <a href="#add-on"><i class="fas fa-chevron-up"></i></a>
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
 <!--End footer-->

<script>

var modal = document.getElementById('id01');


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/forms.js"></script>
    
</body>
</html>