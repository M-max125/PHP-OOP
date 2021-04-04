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
                    <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="recipe.php" class="nav-link active"><i class="fas fa-utensils"></i> Yummy recipes</a>
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
                <?php else :?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Login</a>
                </li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>
<!--End header-->
<section class="cook-cite between" id="cook-cite">
     <div class="container">
        <div class="global-headline">
            <h2 class="sub-headline" style="color: #fff;opacity: 1;line-height: 0.6;">
                    A recipe has no soul,you as a cook, must bring soul to the recipe.
            </h2>
            
            <div class="single-animation" style="margin-top: 15px;">
                <cite>&minus; Thomas Keller</cite>
            </div>

        </div>
     </div>
 </section>
 <!--End cook-cite-->
 <section class="discover">
    <div class="container">
        <div class="exp-info">
            <div class="exp-description padding-right">
                
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ipsam odio omnis alias debitis dicta aut est consectetur delectus ex,
                     temporibus quae. Laborum alias saepe neque odit incidunt, rem culpa!
                </p>
               
            </div>
            <div class="exp-desc-img">
            <h1 class="headline headline-dark" style="margin-bottom: 20px;">Categories</h1>
            <form action="#" method="post" id="recipe-form">
                <label class="contain">Pork
                    <input type="radio" name="category" value="pork">
                    <span class="checkmark"></span>
                </label>
                <label class="contain">Beef
                    <input type="radio" name="category" value="beef">
                    <span class="checkmark"></span>
                </label>
                <label class="contain">Lamb
                    <input type="radio" name="category" value="lamb">
                    <span class="checkmark"></span>
                </label>
                <label class="contain">Chicken
                    <input type="radio" name="category" value="chicken">
                    <span class="checkmark"></span>
                </label>
                <div class="submit-container">
                    <input type="submit" name="submit" value="search recipes" class="submit-btn" id="sbm-btn">
                </div>
                <!-- <div id="submit-message"></div> -->
                
            </form>
            
            </div>
        </div>
    </div>
</section>
<!--End discover category section with radio input-->
<section class="discover">
    <div class="container">
    <?php
    
    if(isset($_POST['submit'])){
        if(isset($_POST['category'])){
            $type = $_POST['category'];
            $ch = curl_init();
            $url = "https://www.themealdb.com/api/json/v1/1/filter.php?c=$type";
    
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            
            $resp = curl_exec($ch);
            
            if($e = curl_error($ch)){
                echo $e;
            }
            else{
                $decoded = json_decode($resp,true);
                
            }
            curl_close($ch);?>

            <?php if($type == 'pork' || $type == 'beef' || $type == 'lamb' || $type == 'chicken'){
                for($i=0;$i<count($decoded['meals']);$i++){
                    echo '<div class="exp-info margin--bottom">';
                    echo '<div class="exp-description padding-right animate-left">';
                    echo '<h2 class="dish-title">'. $decoded['meals'][$i]['strMeal'].'</h2>';
                    $tx = curl_init();
                     $id = $decoded['meals'][$i]['idMeal'];
                    $tx_url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i=$id";
                    
                    curl_setopt($tx,CURLOPT_URL, $tx_url);
                    curl_setopt($tx,CURLOPT_RETURNTRANSFER, true);
                    
                    $response = curl_exec($tx);
                    
                    if($e = curl_error($tx)){
                        echo $e;
                    }
                    else{
                        $text = json_decode($response,true);
                        
                    }
                    curl_close($tx);
            
                    for($j=0;$j<count($text['meals']);$j++){
                        echo '<p>'.$text['meals'][$j]['strInstructions'].'</p>';
                        echo '<h6 class="ing">'."Ingredients".'</h6>';
                        echo '<ul class="ing-list">';
                        for($g=1;$g<20;$g++){
                            
                            echo '<li class="ing-list-item">'.$text['meals'][$j]['strIngredient'.$g]." ". $text['meals'][$j]['strMeasure'.$g].'</li>';
                            
                        }
                        echo '</ul>';
                       
                        
                        
                    }
            
                    echo '</div>';
                        echo '<div class="exp-desc-img animate-right">';
                        echo '<img  src = "'.$decoded['meals'][$i]['strMealThumb'].'" >';
                        echo '</div>';
                     
                     
                    echo '</div>';

                    echo '<hr>';
                    
            
                    
                }
            }
        }
    }
    ?>
        
        
        
    </div>
</section>
<!--End discover section showcase recipes from api-->
<footer>
     <div class="container">
         <div class="back-to-top">
             <a href="#cook-cite"><i class="fas fa-chevron-up"></i></a>
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



    
<script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>

<script src="js/main.js"></script>
    
</body>
</html>