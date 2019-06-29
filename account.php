<?php
session_start();
include_once("db.php");


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<?php

    if(isset($_POST['update'])){
        $yourURL="update_account.php";
        echo ("<script>location.href='$yourURL'</script>");
    }


    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['single_book_id'] = $_POST['id'] ; ;
        $yourURL="single_book.php";
        echo ("<script>location.href='$yourURL'</script>");
    }



?>


<html>

    <head>
        <title>Book Shopping</title>
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
            

            <section class="maincontent account">
                
                <?php
                        
                        $id =  $_SESSION['user_id'] ;
                        
                        $results = $mysqli->query("SELECT * FROM registratedusers  where user_id = '$id'") ;
                        
                        if($results){ 
                             //fetch results set as object and output HTML
                            $obj = $results->fetch_object() ;

                ?>
                   <h3>Your Account Information</h3>
                   <p> Name : <?php echo $obj->fname ." ". $obj->lname ; ?></p>
                   <p> Email : <?php echo $obj->email  ?></p>
                   <p> Password : <?php echo $obj->password  ?></p>
                   <p> Mobile No : <?php echo $obj->mobileno  ?></p>
                   <p> Address : <?php echo $obj->address  ?></p>
                   <p> Gender : <?php echo $obj->gender  ?></p>
                    <form method="post">
                        <input style="border: none;height: 48px;background-color: #F7941D;cursor: pointer;color: white;margin-top: 13px;font-size: 14px;padding: 14px;" type="submit" value="Update Account Information" name="update" >
                        <input type="hidden" value="<?php echo $id; ?>" name="id" >
                    </form>
                <?php
                        }
                ?>
                
                <div>
                    
                     <h3>Your Purchase History</h3>
                    <?php
                        $id =  $_SESSION['user_id'] ;
                        $count = 1 ;
                        $results = $mysqli->query("SELECT * FROM total_purchase  where user_id = '$id'") ;
                        
                        if($results){ 
                            while($obj = $results->fetch_object()){
                           
                    ?>
                        <b> Purchase <?php echo $count++ ?></b>
                        <p> DATE : <?php echo $obj->purchase_date ?></p>
                        <p> TOTAL PURCHASE : <?php echo $obj->purchase_total ?></p>
                        
                    <?php
                            }
                        }
                        else{
                            echo "0 Purchase";
                        }    
                        
                    ?>
                </div>
            </section>
            
        </section>

        <footer>


        </footer>
    </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            

    </body>

</html>