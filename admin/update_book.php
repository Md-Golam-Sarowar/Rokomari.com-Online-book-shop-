<?php

    session_start();
    include '../db.php';
    
?>

<?php
    
    if(isset($_POST['update']))
    {
        

                    $id = $_POST['id'];
                    $bookname = $_POST['book_name'];
                    $bookcode = $_POST['book_code'] ;
                    $bookprice = $_POST['book_price'] ;
                    $bookavailable = $_POST['books_available'] ;
                    $bookauthor = $_POST['book_author'] ;
                    $bookpublishers = $_POST['book_publishers'] ;
                    $bookssold = $_POST['books_sold'] ;
                        
                    $sql = "UPDATE books SET book_name = '$bookname', book_code = '$bookcode', 
                    book_price = '$bookprice', books_available = '$bookavailable', book_author = '$bookauthor', book_publishers = '$bookpublishers', books_sold = '$bookssold' WHERE book_id = '$id'" ;

                    $result = $mysqli->query($sql);

                    if($result) {
                        $msg = "Successfully Updated!!";
                        echo $msg ;
                    }
                    else{
                        $msg = "Not!!";
                        echo $msg ;
                    }

    }

        
?>
<html>

    <head>
        <title>Book Shopping : Admin Update Book Page</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        
        <style>
            table,tr,th,td{border: 1px solid #000 ;border-collapse: collapse}
        </style>
    </head>
    <body>
    <div class="main">

        <header>
            
            <div class="time_header">
                <p>Call : 16297 <span>9:00 am - 11:00 pm , 7 days a week</span></p>
                <ul class="head_menu">
                    <li><a href="#">Support</a></li>
                    <li><a href="#">About Us</a></li>
                   <?php 
                        if($_SESSION["user_type"]=="admin")
                         {
                            echo "<li><a href=\"admin_page.php\">Account</a></li>";
                            echo "<li><a href=\"../logout.php\">Logout</a></li>";
                           
                         }
                        else if($_SESSION["user_type"]=="buyer")
                         {
                            echo "<li><a href=\"account.php\">Account</a></li>";
                            echo "<li><a href=\"../logout.php\">Logout</a></li>";
                           
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
                            echo "<li><a href=\"../view_cart.php\">Cart(".$total_items.")</a></li>";
                        }
             
                    ?>

                </ul>
            </div>
            <div class="logo">

                 <a href="../index.php"><img src="../images/LOGO.png" alt="Book Shopping" ></a>
            </div>
            <div class="search_top">
                <form>
                    <input type="text" name="search" placeholder="Enter Keyword">
                    <input type="submit" name="search" value="Search">
                </form>
            
            </div>
        
        </header>
        
        
        <section class="menu admin_menu">
                 <ul>
                     
                    <li><a href="../index.php" title="home" class="current"><span>Home</span></a></li>
                    <li><a href="insert_book.php" title="insert_book" ><span>Insert Book</span></a></li>
                    <li><a href="update_book.php" title="update_book"><span>Update Book</span></a></li>
                    <li><a href="notifications.php" title="notifications"><span>Notifications</span></a></li>
                    <li><a href="update_users.php" title="update_users"><span>Update Users</span></a></li>

                </ul>
        </section>
        
        <section class="content">

            <section class="maincontent update_books">
                <?php

                  $getselect = mysqli_query($mysqli, "SELECT * FROM books ");
                  echo "<div class=\"display\">" ;
                  echo "" ;          
                  while( $user=mysqli_fetch_array($getselect) ) {
            
                ?>
                        <form method="post" name="">
                           <table>
                            <tr>
                            
                                <td>
                                    <input type="text" name="book_name" value="<?php echo $user['book_name']; ?>" />
                                </td>
                                <td>
                                    <input type="text" name="book_author" value="<?php echo $user['book_author']; ?>" />
                                </td>    
                                <td>
                                    <input type="text" name="book_publishers" value="<?php echo $user['book_publishers']; ?>" />
                                </td>
                                <td>
                                    <input type="text" name="book_price" value="<?php echo $user['book_price']; ?>" />
                                </td>
                                <td>    
                                    <input type="text" name="book_category" value="<?php echo $user['book_category']; ?>" />
                                </td>
                                <td>    
                                    <input type="text" name="book_code" value="<?php echo $user['book_code']; ?>" />
                               </td>
                                <td>    
                                    <input type="text" name="books_available" value="<?php echo $user['books_available']; ?>" />
                                 </td>
                                <td>    
                                    <input type="text" name="books_sold" value="<?php echo $user['books_sold']; ?>" />
                                 </td>
                                
                                <td>
                                    <input type="submit" name="update" value="Update" id="inputid" />
                                </td>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['book_id']) ;?>" />
                                
                                
                            </tr>
               
                        </table></form>
                <?php } 
                    echo "</div>";
                ?>     

                
            </section>
        </section>
       
        
        </div>
        
    </body>
    
</html>    