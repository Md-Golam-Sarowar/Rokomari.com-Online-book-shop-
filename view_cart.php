<?php
session_start();
include_once("db.php");

    $error = "";
    if(isset($_POST["order"])){
        
        if( $_SESSION["user_type"] == "buyer" ){
            $_SESSION["total"] = $_POST["total"] ;
            $yourURL="shopping_finalize.php";
            echo ("<script>location.href='$yourURL'</script>"); 
        }
        else
            $error = "<p style=\"margin-bottom:5px ;\">Please <a href=\"registration_login.php\" style=\"color:blue;text-decoration:none;\">Login</a> First! </p>";
           
    }
    
    


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
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

            <section class="maincontent">

       <div class="cart-view-table-back">
        <form method="post" action="cart_update.php">
        
          <?php  echo $error ; ?>
            
        <table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Quantity</th><th>Name</th><th>Price</th><th>Total</th><th>Remove</th></tr></thead>
          <tbody>
            <?php
            if(isset($_SESSION["cart_products"])) //check session var
            {
                $total = 0; //set initial total value
                $b = 0; //var for zebra stripe table 

                foreach ($_SESSION["cart_products"] as $cart_itm)
                {
                    //set variables to use in content below
                    $book_name = $cart_itm["book_name"];
                    $product_qty = $cart_itm["product_qty"];
                    $book_price = $cart_itm["book_price"];
                    $book_code = $cart_itm["book_code"];

                    $subtotal = ($book_price * $product_qty); //calculate Price x Qty

                    $bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
                    echo '<tr class="'.$bg_color.'">';
                    echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$book_code.']" value="'.$product_qty.'" /></td>';
                    echo '<td>'.$book_name.'</td>';
                    echo '<td>'.$currency.$book_price.'</td>';
                    echo '<td>'.$currency.$subtotal.'</td>';
                    echo '<td><input type="checkbox" name="remove_code[]" value="'.$book_code.'" /></td>';
                    echo '</tr>';
                    $total = ($total + $subtotal); //add subtotal to total var
                }

                $grand_total = $total ; //grand total including shipping cost
                foreach($taxes as $key => $value){ //list and calculate all taxes in array
                        $tax_amount     = round($total * ($value / 100));
                        $tax_item[$key] = $tax_amount;
                        $grand_total    = $grand_total + $tax_amount;  //add tax val to grand total
                }

                $list_tax       = '';
                foreach($tax_item as $key => $value){ //List all taxes
                    $list_tax .= $key. ' : '. $currency. sprintf("%01.2f", $value).'<br />';
                }

            }
            ?>
            <tr><td colspan="5"><span style="float:right;text-align: right;"><?php echo  $list_tax; ?>Amount Payable : <?php echo sprintf("%01.2f", $grand_total);?></span></td></tr>
            <tr><td colspan="5"><a href="index.php" class="button">Add More Items</a><button type="submit">Update</button>
                </td></tr>


          </tbody>
        </table>
        <input type="hidden" name="return_url" value="<?php 
        $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        echo $current_url; ?>" />

        </form>

            <form method="post" > <input type="submit" class="button" value="Order" name="order"/><input type="hidden"  value="<?php echo $grand_total ;?>" name="total"/></form>

        </div>

           
            </section>

        </section>

        <footer>


        </footer>
    </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            

    </body>

</html>