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
                    <a href="recipe.php" class="nav-link"><i class="fas fa-utensils"></i> Yummy recipes</a>
                </li>
                <li class="nav-item">
                    <a href="facts.php" class="nav-link active"><i class="far fa-newspaper"></i> Food Facts</a>
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

<?php
function get_rss_feed_as_html($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0, $cache_timeout = 7200, $cache_prefix = "/tmp/rss2html-")
{
    $result = "";
    // get feeds and parse items
    $rss = new DOMDocument();
    $cache_file = $cache_prefix . md5($feed_url);
    // load from file or load content
    if ($cache_timeout > 0 &&
        is_file($cache_file) &&
        (filemtime($cache_file) + $cache_timeout > time())) {
            $rss->load($cache_file);
    } else {
        $rss->load($feed_url);
        if ($cache_timeout > 0) {
            $rss->save($cache_file);
        }
    }
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        $content = $node->getElementsByTagName('encoded'); // <content:encoded>
        if ($content->length > 0) {
            $item['content'] = $content->item(0)->nodeValue;
        }
        array_push($feed, $item);
    }
    // real good count
    if ($max_item_cnt > count($feed)) {
        $max_item_cnt = count($feed);
    }
    $result .= '<ul class="feed-lists">';
    for ($x=0;$x<$max_item_cnt;$x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $result .= '<li class="feed-item animate-left">';
        $result .= '<div class="feed-title"><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong></div>';
        if ($show_date) {
            $date = date('l F d, Y', strtotime($feed[$x]['date']));
            $result .= '<small class="feed-date"><em>Posted on '.$date.'</em></small>';
        }
        if ($show_description) {
            $description = $feed[$x]['desc'];
            $content = $feed[$x]['content'];
            // find the img
            $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            // no html tags
            $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');
            // whether cut by number of words
            if ($max_words > 0) {
                $arr = explode(' ', $description);
                if ($max_words < count($arr)) {
                    $description = '';
                    $w_cnt = 0;
                    foreach($arr as $w) {
                        $description .= $w . ' ';
                        $w_cnt = $w_cnt + 1;
                        if ($w_cnt == $max_words) {
                            break;
                        }
                    }
                    $description .= " ...";
                }
            }
            // add img if it exists
            if ($has_image == 1) {
                $description = '<img  src="' . $image['src'] . '" />' . $description;
            }
            $result .= '<div class="feed-description">' . '<p>'.$description.'</p>';
            $result .= ' <a href="'.$link.'" target="_blank" title="'.$title.'">Continue Reading &raquo;</a>'.'</div>';
        }
        $result .= '</li>';
    }
    $result .= '</ul>';
    return $result;
}

function output_rss_feed($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0)
{
    echo get_rss_feed_as_html($feed_url, $max_item_cnt, $show_date, $show_description, $max_words);
}

?>
<section id="intro-feed">

</section>
<!--End intro-feed -->
<section class="rss-feed">
    <div class="container">
    <?php
// output RSS feed to HTML
output_rss_feed('https://www.bestfoodfacts.org/feed/', 20, true, true, 200);
?>
    </div>
</section>

<!--End rss-feed-->

<footer>
     <div class="container">
         <div class="back-to-top">
             <a href="#intro-feed"><i class="fas fa-chevron-up"></i></a>
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