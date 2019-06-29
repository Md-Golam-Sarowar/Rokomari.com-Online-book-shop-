<?php

session_start();
include_once("../db.php");

?>

<?php

            if(isset($_POST['update']))
            {
                    $id = $_POST['id'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'] ;
                    $password = $_POST['password'] ;
                    $mobileno = $_POST['mobileno'] ;
                    $address = $_POST['address'] ;
                    $date = $_POST['date'] ;
                    $gender = $_POST['gender'] ;
                    $user_type = $_POST['user_type'] ;
                    $request = $_POST['request'] ;
                        
                    $sql = "UPDATE registratedusers SET fname = '$fname', lname = '$lname', 
                    email = '$email', password = '$password', mobileno = '$mobileno', address = '$address', date = '$date', gender = '$gender', user_type = '$user_type', Request = '$request' WHERE user_id = '$id'" ;

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
        <title>Book Shopping : Admin Update Users</title>
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
                            echo "<li><a href=\"./view_cart.php\">Cart(".$total_items.")</a></li>";
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

            <section class="maincontent update_users">
                <?php

                  $getselect = mysqli_query($mysqli, "SELECT * FROM registratedusers ");
                  echo "<div class=\"display\">" ;
                  echo "" ;          
                  while( $user=mysqli_fetch_array($getselect) ) {
            
                ?>
                        <form method="post" name="">
                           <table>
                            <tr>
                            
                                <td>
                                    <input type="text" name="fname" value="<?php echo $user['fname']; ?>" />
                                </td>
                                <td>
                                    <input type="text" name="lname" value="<?php echo $user['lname']; ?>" />
                                </td>    
                                <td>
                                    <input type="text" name="email" value="<?php echo $user['email']; ?>" />
                                </td>
                                <td>
                                    <input type="text" name="password" value="<?php echo $user['password']; ?>" />
                                </td>
                                <td>    
                                    <input type="text" name="mobileno" value="<?php echo $user['mobileno']; ?>" />
                                </td>
                                <td>    
                                    <input type="text" name="address" value="<?php echo $user['address']; ?>" />
                                </td>
                                <td>    
                                    <input type="text" name="date" value="<?php echo $user['date']; ?>" />
                               </td>
                                <td>    
                                    <input type="text" name="gender" value="<?php echo $user['gender']; ?>" />
                                 </td>
                                <td>    
                                    <input type="text" name="user_type" value="<?php echo $user['user_type']; ?>" />
                                 </td>
                                <td>    
                                    <input type="text" name="request" value="<?php echo $user['Request']; ?>" />
                                 </td>
                                <td>
                                    <input type="submit" name="update" value="Update" id="inputid" />
                                </td>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['user_id']) ;?>" />
                                
                                
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