<?php

    session_start();
    include '../db.php';
    if(isset($_POST['update']))
    {
       $id = $_POST['id'];
       $request = $_POST['request'];
       $type = $_POST['type'];
        
        $sql = "UPDATE registratedusers SET user_type = '$type', Request = '$request'  WHERE user_id = '$id'" ;

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

    if(isset($_POST['purchase']))
    {
       $id = $_POST['id'];
       $request = $_POST['purchase_request'];
       $userid = $_POST['userid'];
       $total = $_POST['total'];
       $date = $_POST['date'];
        
        $sql = "UPDATE total_purchase SET user_id = '$userid', purchase_request = '$request' , purchase_total = '$total', purchase_date = '$date'  WHERE purchase_id = '$id'" ;

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
        <title>Book Shopping : Admin Delete Book Page</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        
        <style>
            table,tr,th,td{border: 1px solid #000 ;border-collapse: collapse}
            th{background: #ddd;color: black}
            th,td,input{width: 130px;text-align: center}
            input{border-style: none}
            .Message tr td:last-child{
                width: 250px
            }
            .Message tr td:nth-child(2){
                width: 250px
            }
            .Message tr td:nth-child(3){
                width: 230px
            }
        </style>
    </head>
    <body>
    <div class="main">

        <header>
            
            <div class="time_header">
                <p>Call : 16297 <span>9:00 am - 11:00 pm , 7 days a week</span></p>
                <ul class="head_menu">
                    <li><a href="../support.php">Support</a></li>
                    <li><a href="../about.php">About Us</a></li>
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

            <section class="maincontent notifications">
                
                <?php
                    
                    $results = $mysqli->query("SELECT * FROM registratedusers where Request = 'Pending'; ");
                    
                echo "<h2>User Registration Pending</h2>";
                    
                if(mysqli_num_rows($results)>0){ 
                    echo "<div class=\"user\">";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Request</th><th>Type</th><th>Submit</th></tr>";
                    while($obj = mysqli_fetch_assoc($results))
                    {   
                    
                ?>  
                    <form method="post">
                        <tr><td><input type="text"  name="id" value="<?php echo $obj['user_id']; ?>" /></td>
                        <td><input type="text"  name="request" value="<?php echo $obj['Request']; ?>" /></td>
                        <td><input type="text"  name="type" value="<?php echo $obj['user_type']; ?>" /></td>
                        <td><input type="submit" name="update" value="Update"  />
                        </td></tr>
                    </form>
                <?php
                   
                    }
                     echo "</table></div>";
                }
                else{
                    echo "<center>No Notifications</center>";
                }
                    
                ?>
                
                <?php
                    
                    $results = $mysqli->query("SELECT * FROM total_purchase where purchase_request = 'Pending'; ");
                    
                echo "<h2>Purchase Request</h2>";
                    
                if(mysqli_num_rows($results)>0){
                    echo "<div class=\"purchase\">";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Date</th><th>Total</th><th>User Id</th><th>Request</th><th>Submit</th></tr>";
                    while($obj = mysqli_fetch_assoc($results))
                    {   
                    
                ?>  
                    <form method="post">
                        <tr><td><input type="text"  name="id" value="<?php echo $obj['purchase_id']; ?>" /></td>
                        <td><input type="text"  name="date" value="<?php echo $obj['purchase_date']; ?>" /></td>
                        <td><input type="text"  name="total" value="<?php echo $obj['purchase_total']; ?>" /></td>
                        <td><input type="text"  name="userid" value="<?php echo $obj['user_id']; ?>" /></td>
                        <td><input type="text"  name="purchase_request" value="<?php echo $obj['purchase_request']; ?>" /></td>
                        <td><input type="submit" name="purchase" value="Update"  />
                        </td></tr>
                    </form>
                <?php
                   
                    }
                    echo "</table></div>";
                }
                else{
                    echo "<center>No Notifications</center>";
                }
                    
                ?>
                
                <?php
                    
                    $results = $mysqli->query("SELECT * FROM msg ; ");
                    
                echo "<h2>Customer's Message </h2>";
                    
                if(mysqli_num_rows($results)>0){
                    echo "<div class=\"Message\">";
                    echo "<table>";
                    echo "<tr><th>User Id</th><th>Email</th><th>Subject</th><th>Message</th></tr>";
                    while($obj = mysqli_fetch_assoc($results))
                    {   
                    
                ?>  
                    <form method="post">
                        <tr><td><?php echo $obj['user_id']; ?></td>
                        <td><?php echo $obj['email']; ?></td>
                        <td><?php echo $obj['subject']; ?></td>
                        <td><?php echo $obj['msg']; ?></td>
                        </tr>
                    </form>
                <?php
                   
                    }
                    echo "</table></div>";
                }
                else{
                    echo "<center>No Notifications</center>";
                }
                    
                ?>
                
            </section>
            
        </section>    
        
        </div>
        
    </body>
    
</html>    