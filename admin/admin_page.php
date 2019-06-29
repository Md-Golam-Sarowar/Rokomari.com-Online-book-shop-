<?php

    session_start();
    include '../db.php';


        if(isset($_POST['update']))
            {       
                    echo 'dfdf';
                    $id = $_POST['id'];
                    $date = $_POST['delivered_date'];
                    $delivered = $_POST['delivered'];
                    
                    $sql = "UPDATE total_purchase SET delivered_date = '$date', delivered = '$delivered' WHERE purchase_id = '$id' " ;
                    
                    $result = $mysqli->query($sql);

                    if($result) {
                        $msg = "Successfully Updated!!";
                     }
                    else{
                        $msg = "Not!!";
                        echo $msg ;
                    }

            }

?>

<html>

    <head>
        <title>Book Shopping : Admin Page</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        
        <style>
            table {
            color: #333;
            font-family: Helvetica, Arial, sans-serif;
            width: 1150px;
            border-collapse:collapse; 
            border-spacing: 0;
            }

            td, th {
            border: 1px solid #000; /* No more visible border */
            height: 30px;
            transition: all 0.3s; /* Simple transition for hover effect */
            }

            th {
            background: #DFDFDF; /* Darken header a bit */
            font-weight: bold;
            }

            td {
            background: #FAFAFA;
            text-align: center;
            width: 130px;
            }
            
            .display1 tr td:first-child{
                width: 250px
            }
            
            .display1 tr td:nth-child(2){
                width: 250px
            }
            
            .display1 tr td:nth-child(3){
                width: 250px
            }
            
            .display2 tr td:first-child{
                width: 60px
            }
            
            .display2 tr td:nth-child(5){
                width: 250px
            }
            .display3 input {
                border: none;
                width: 100%;
                text-align: center
            }
            
            .result{
                margin-top: 30px
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
                              echo "<li><a href=\"../registration_login.php\">Account</a></li>";
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

            <section class="maincontent all">

                <?php
                    
                  $getselect = mysqli_query($mysqli, "SELECT * FROM books ");
                  echo "<div class=\"display1\">" ;
                  echo "<h2>Book List</h2>" ;    
                  echo "<table>" ;
                  echo "<tr><th>Book Name</th><th>Author Name</th><th>Publisher</th><th>Price</th><th>Category</th><th>Code</th><th>Available</th><th>Sold</th></tr>";
                  while( $product=mysqli_fetch_array($getselect) ) {
            
                ?>

                            <tr>
                                <td>
                                    <?php echo $product['book_name']; ?>
                                </td>
                                <td>
                                    <?php echo $product['book_author']; ?>
                                </td>    
                                <td>
                                    <?php echo $product['book_publishers']; ?>
                                </td>
                                <td>
                                    <?php echo $product['book_price']; ?>
                                </td>
                                <td>    
                                    <?php echo $product['book_category']; ?>
                                </td>
                                <td>    
                                   <?php echo $product['book_code']; ?>
                                </td>
                                <td>    
                                    <?php echo $product['books_available']; ?>
                               </td>
                                <td>    
                                    <?php echo $product['books_sold']; ?>
                                 </td>

                            </tr>
               
                        
                <?php } 
                    echo "</table></div>";
                ?>                 
                
                <?php
                    
                  $getselect = mysqli_query($mysqli, "SELECT * FROM registratedusers ");
                  echo "<div class=\"display2\">" ;
                  echo "<h2>User List</h2>" ;    
                  echo "<table>" ;
                  echo "<tr><th>ID</th><th>User Name</th><th>Email</th><th>Mobile No</th><th>Address</th><th>Gender</th><th>User Type </th></tr>";
                  while( $product=mysqli_fetch_array($getselect) ) {
            
                ?>

                            <tr>
                                <td>
                                    <?php echo $product['user_id']; ?>
                                </td>
                                <td>
                                    <?php echo $product['fname'] ." ".$product['lname']; ?>
                                </td>    
                                <td>
                                    <?php echo $product['email']; ?>
                                </td>
                                <td>
                                    <?php echo $product['mobileno']; ?>
                                </td>
                                <td>    
                                    <?php echo $product['address']; ?>
                                </td>
                                <td>    
                                   <?php echo $product['gender']; ?>
                                </td>
                                <td>    
                                    <?php echo $product['user_type']; ?>
                               </td>
                                
                            </tr>
               
                        
                <?php } 
                    echo "</table></div>";
                ?>                  
                
                <?php
                    
                  $getselect = mysqli_query($mysqli, "SELECT * FROM total_purchase");
                  echo "<div class=\"display3\">" ;
                  echo "<h2>Ordered Lists</h2>" ;    
                  echo "<table>" ;
                  echo "<tr><th>Purchase Id</th><th>Delivered</th><th>Purchase Total</th><th>Delivered Date</th><th>Submit</th></tr>";
                  while( $product=mysqli_fetch_array($getselect) ) {
            
                ?>
                            <form method="post">
                                <tr>
                                    <td>
                                       <input type="text"  value="<?php echo $product['purchase_id']; ?>" name="id" >
                                    </td>
                                    <td>
                                        <input type="text"  value="<?php echo $product['delivered'] ; ?>" name="delivered" >
                                    </td>
                                    <td>
                                        <input type="text"  value="<?php echo $product['purchase_total'] ; ?>" name="delivered" >
                                    </td>
                                    <td>
                                        <input type="text"  value="<?php echo $product['delivered_date'] ; ?>" name="delivered_date" >
                                    </td> 
                                    <td>
                                        <input type="submit"  value="Update" name="update" >
                                    </td>    
                                </tr>
                            </form>
                         
                <?php } 
                    echo "</table></div>";
                ?>  
                
                <div class="result">
                        
                        <?php
                                echo "<h2>Selling Income</h2>";
                    
                                $today = "0" ;
                                $month = "0" ;
                                $year = "0" ;
                    
                                $todaysql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE DATE(purchase_date) = curdate() ; ";
                        
                                $monthsql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE MONTH(purchase_date) = MONTH(curdate()) ; ";
                        
                                $yearsql = "SELECT sum(purchase_total) as total FROM total_purchase WHERE YEAR(purchase_date) = YEAR(curdate()) ; ";
                                
                                $todayresult = $mysqli->query($todaysql) ;
                                $monthresult = $mysqli->query($monthsql) ;
                                $yearresult = $mysqli->query($yearsql) ;
                                
                                 
                                if($row = $todayresult->fetch_assoc())
                                   $today = $row['total']  ;
                                
                                
                                if($row = $monthresult->fetch_assoc())
                                    $month = $row['total'] ;
                                
                                if($row = $yearresult->fetch_assoc())
                                    $year = $row['total']."</p>" ;
                                
                                echo "<table>" ;
                    
                                echo "<tr><th>Today</th><th>Month</th><th>Year</th></tr>" ;
                                echo "<tr><th>".$today."</th><th>".$month."</th><th>".$year."</th></tr>" ;
                                
                                echo "</table>"
                          ?>
                        
                 </div>
          
            </section>
        </section>
        
        </div>
        
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>

    </body>
    
</html>    