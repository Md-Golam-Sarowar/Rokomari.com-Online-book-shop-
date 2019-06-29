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

?>


<html>

    <head>
        <title>Book Shopping</title>
        
        <link rel="stylesheet" type="text/css" href="css/lightbox.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        
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
            <div class="search_top">
                <form>
                    <input type="text" name="search" placeholder="Enter Keyword">
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
        

        <section class="content">
            


            
            <section class="maincontent single_book">
                    <?php 
                        
                        $id =  $_SESSION['single_book_id'] ;
                
                        $results = $mysqli->query("SELECT * FROM books natural join product_images where book_id = '$id'") ;
                        
                        if($results){ 
                                
                            //fetch results set as object and output HTML
                            $obj = $results->fetch_object() ;
                            
                            $available = $obj->books_available;
                             

                         ?>
                        
 
                <div class="single_book_left">
                    
                    <?php
                       
                        echo "<h2 style=\"color:#000;font-size:26px;border-bottom:2px solid #9FE94C;padding-bottom:5px;    margin-left: 10px; width: 248px;}\">$obj->book_name </h2>" ;
                        echo "<ul>" ;
                        echo "<li>" ;
                        
                        echo "<img src='images/books/$obj->image' width=\"200\" class=\"js-lightbox\" data-role=\"lightbox\" data-source='images/books/$obj->image' data-group=\"group-1\" data-id=\"1\" data-caption=\"$obj->book_name\">" ;
                            
                        echo "</li>" ;
                        echo "</ul>" ;   
                            
                       
                           
                    ?>
                    
                    
                </div>
                <div class="single_book_right">
                       <?php
                            if($available==0){
                                echo "<b style=\"color:Red;font-size:20px;margin-top:5px\">Out of Stock!</b>";
                            }
                            else{
                                
                            
                        ?>
                          
                      <form method="post" action="cart_update.php">
                          <p style="color:#0897D6;font-size:20px"><span style="color:#000;">Price : </span><?php echo $currency , $obj->book_price ?></p>
                          <p style="color:#0897D6;font-size:20px;margin-top:5px"><span style="color:#000;">Quantity : </span><input type="text" size="2" maxlength="2" name="product_qty" value="1" />      
                          <input type="hidden" name="book_code" value="<?php echo $obj->book_code ?>" />
                          <input type="hidden" name="type" value="add" />
                          <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                          <input type="submit" class="add_to_cart" value="Add" name="submit">
                          </p> 
                      </form>

  
                 <?php } } ?>    
                              
                </div>
                
            </section>
            
            <section>
             
                <div class="single_book_other">
                    <?php
                       
                        $id =  $_SESSION['single_book_id'] ;
                        $sql = $mysqli->query("SELECT book_category FROM books where book_id = '$id'") ;

                        $obj = $sql->fetch_object() ;
                    
                                $category = $obj->book_category ;
                                
                                $results = $mysqli->query("SELECT * FROM books natural join product_images where book_category = '$category' and book_id != '$id'  LIMIT 5  ; ");
                                
                                if(mysqli_num_rows($results)>0){ 
                                    $products_item = '<div class="new_books">';
                                    echo "<h2>This Category Books</h2>" ;    
                                    //fetch results set as object and output HTML
                                    while($obj = $results->fetch_object())
                                    {
                                    
                                      echo  "<div class=\"part\">" ;
                                      echo  "<form method=\"post\"> ";
                                      
                                      echo "<input type=\"image\" src=\"images/books/{$obj->image}\" > ";  
                                      echo "<p style=\"color:#0897D6;font-size:16px;margin-top:3px\">{$obj->book_name}</p>" ;
                                      echo "<p style=\"color:#000;font-size:16px;margin-top:2px\">Price :{$currency}{$obj->book_price}</p>" ;
                                      echo "<input type=\"hidden\" value=\"{$obj->book_id}\" name=\"id\"> ";

                                       echo "</form></div>";
                                    
                                    }
                                    
                                    echo "</div>" ;
                                }
                              
                    ?>
                    
                </div>
                
            </section>
            
        </section>

        <footer>


        </footer>
    </div>
        
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>  
        <script type="text/javascript" src="js/lightbox.js"></script>    
          
        <script type="text/javascript">
            $(function(){
                var lightbox = new LightBox({});
            });
        </script>
    </body>

</html>