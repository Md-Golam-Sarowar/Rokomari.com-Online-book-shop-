<?php
session_start();
include_once("db.php");


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['single_book_id'] = $_POST['id'] ; ;
        $yourURL="single_book.php";
        echo ("<script>location.href='$yourURL'</script>");
    }

    if(isset($_GET['view_all'])){
        
        $yourURL="viewall.php";
        echo ("<script>location.href='$yourURL'</script>");
        
    }


?>


<html>

    <head>
        <title>Book Shopping</title>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/hover_image.css" />
        
    </head>
    <body>
    <div class="main">

        <header>
            
            <div class="time_header">
                <p>Call : 16297 <span>9:00 am - 11:00 pm , 7 days a week</span></p>
                <ul class="head_menu">
                    <li><a href="support.php">Support</a></li>
                    <li><a href="about.php">About Us</a></li>
                   <?php 
                        if($_SESSION["user_type"]=="admin")
                         {
                            echo "<li><a href=\"admin/admin_page.php\">Account</a></li>";
                            echo "<li><a href=\"logout.php\">Logout</a></li>";
                           
                         }
                        else if($_SESSION["user_type"]=="buyer")
                         {
                            echo "<li><a href=\"account.php\">Account</a></li>";
                            echo "<li><a href=\"logout.php\">Logout</a></li>";
                           
                         }
                         else
                         {
                              // session has NOT been started
                              echo "<li><a href=\"registration_login.php\">Account</a></li>";
                         }
                         
                        if(isset($_SESSION["cart_products"])){
                            $total_items = 0 ;
                            foreach ($_SESSION["cart_products"] as $cart_itm)
                            {
                                $total_items += $cart_itm["product_qty"];  
                            }
                            echo "<li><a href=\"view_cart.php\">Cart(".$total_items.")</a></li>";
                        }
             
                    ?>

                </ul>
            </div>
            <div class="logo">

                 <a href="index.php"><img src="images/LOGO.png" alt="Book Shopping" ></a>
                
            </div>
            <div class="search_top" >
                <form method="get" action="search_book.php">
                    <input type="text" name="search_text" id="search_text" placeholder="Enter Book Name" class="form-control" />
                    <input type="submit" name="search" value="Search">
                </form>
            
            </div>
        
        </header>
        
        
        <section class="menu">
                 <ul>
                    <li><a href="index.php" title="home" class="current"><span>HOME</span></a></li>
                     <li><a href="categories.php" title="products"><span>CATEGORIES</span></a></li>
                     <li><a href="publishers.php" title="products"><span>PUBLISHERS</span></a></li>
                </ul>
        </section>
        
        
        <section class="slider">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    <img src="images/toystory.jpg" data-thumb="images/toystory.jpg" alt="" />
                    <a href="http://dev7studios.com"><img src="images/up.jpg" data-thumb="images/up.jpg" alt="" title="This is an example of a caption" /></a>
                    <img src="images/walle.jpg" data-thumb="images/walle.jpg" alt="" data-transition="slideInLeft" />
                    <img src="images/nemo.jpg" data-thumb="images/nemo.jpg" alt="" title="#htmlcaption" />
                </div>
                <div id="htmlcaption" class="nivo-html-caption">
                    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
                </div>
            </div>
        </section>
        


        <section class="content">

            <section class="maincontent">

 

                        
<!-- Products List Start -->
<?php
$results = $mysqli->query("SELECT * FROM books natural join product_images ORDER BY book_id DESC LIMIT 5  ");
if($results){ 
$products_item = '<div class="new_books">';
echo "<h2 class=\"title_header\">New Books</h2>" ;    
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<div class="part view view-first">
	<form method="post" >
        
       <input type="image" src="images/books/{$obj->image}" >
       <input type="hidden" value="{$obj->book_id}" name="id">
       <div class="mask">
           <h3>{$obj->book_name}</h3>
           <p>Price :{$currency}{$obj->book_price}</p>
           <input type="submit"  class="info" value="Details" name="single">
        </div>
	</form>
	</div>
EOT;
}
$products_item .= '</div>';
echo $products_item;
}
?> 
                

                        
    <form method="get" >
                  
          <input style="background:black;color:white;border:none;padding:10px;cursor:pointer;margin:20px 560px" type="submit" value="View All" name="view_all"/>
          <input type="hidden" value="all" name="name_all"/>
                             
    </form> 
                
                
<?php
$results = $mysqli->query("SELECT * FROM books natural join product_images where books_sold > 10 ORDER BY book_id DESC LIMIT 5  ");
if(mysqli_num_rows($results)){ 
$products_item = '<div class="new_books">';
echo "<h2 class=\"title_header\">Best Selling Books</h2>" ;    
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<div class="part view view-first">
	<form method="post" >
        
       <input type="image" src="images/books/{$obj->image}" >
       <input type="hidden" value="{$obj->book_id}" name="id">
       <div class="mask">
           <h3>{$obj->book_name}</h3>
           <p>Price :{$currency}{$obj->book_price}</p>
           <input type="submit"  class="info" value="Details" name="single">
        </div>
	</form>
	</div>
EOT;
}
$products_item .= '</div>';
echo $products_item;
}
?>
                
            </section>

        </section>

    <footer>
        <p>All Rights Reserved | Arif-Ul-Islam</p>
    </footer>
        
        
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            
            </script>

    </body>

</html>