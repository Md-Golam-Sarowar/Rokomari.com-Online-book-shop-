
<?php

    session_start();

?>

<?php

    include '../db.php';

    
    if(isset($_POST['submit_book']))
    {
        
        $book_name = $_POST['book_name'];
        $book_author = $_POST['book_author'];
        $book_publishers = $_POST['book_publishers'];
        $book_price = $_POST['book_price'];
        $book_category = $_POST['book_category'];
        $book_code = $_POST['book_code'];
        $books_available = $_POST['books_available'];
        $book_sold = $_POST['book_sold'];

        $target_dir = "../images/Books/";
        $target_file = $target_dir . basename($_FILES["book_image"]["name"]);
        
        $book_image = $_FILES["book_image"]["name"] ;

        $sql = "INSERT INTO books (book_name, book_author, book_publishers,book_price,book_category,book_code,books_available,books_sold)
                    VALUES ('$book_name', '$book_author', '$book_publishers','$book_price','$book_category','$book_code','$books_available','$book_sold');";
    
        if ($mysqli->query($sql) === TRUE ) {
            echo "Record Added Succesfully!!";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        
        if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
            $img_sql = "INSERT INTO product_images (book_name, image) VALUES ('$book_name', '$book_image')" ;
            $mysqli->query($img_sql) ;
            echo " The file ". basename( $_FILES["book_image"]["name"]). " has been uploaded.";
        }
    }


?>

<html>

    <head>
        <title>Book Shopping : Admin Insert Page </title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
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
                     <li><a href="delete_book.php" title="delete_book"><span>Delete Book</span></a></li>
                     <li><a href="update_users.php" title="update_users"><span>Update Users</span></a></li>

                </ul>
        </section>
        
        
        <section class="maincontent book_entry">
        
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
              <div>
                <label class="desc" >Book Name</label>
                <div id="Field1">
                  <input  name="book_name" type="text" >
                </div>
              </div>
                
                <div>
                <label class="desc" >Book Code</label>

                <div id="Field1">
                    <input  name="book_code" type="text"  > 
                  </div>
                </div>
                
              <div>
                <label class="desc" >Author Name</label>
                <div id="Field1">
                  <input  name="book_author" type="text" > 
               </div>
              </div>

              <div>
                <label class="desc" >Publisher Name</label>
                  <div id="Field1">
                    <input id="Field3" name="book_publishers" type="text" > 
                  </div>
               </div>


              <div>
                <label class="desc" >Select a Category</label>
                <div id="Field1">
                <select  name="book_category"> 
                  <option value="Islamic">Islamic</option>
                  <option value="Science">Science</option>
                  <option  value="Literature">Literature</option>
                  <option  value="Programming">Programming</option>
                  <option  value="Computer Science">Computer Science</option>
                  <option  value="Funny">Funny</option>
                </select>
                </div>
              </div>
                
                <div>
                <label class="desc" >Price</label>

                <div id="Field1">
                    <input  name="book_price" type="number"  > 
                  </div>
                </div> 
                 
                
                <div>
                <label class="desc" >Books Available</label>

                <div id="Field1">
                    <input  name="books_available" type="number" > 
                  </div>
                </div>
                
                <div>
                <label class="desc" >Book Sold</label>

                <div id="Field1">
                    <input  name="book_sold" type="number"  > 
                  </div>
                </div>                
                
                <div id="Field1">
                <label class="desc" >Book Image</label>

                <div id="Field1">
                    <input  name="book_image" type="file"  > 
                </div>
              </div>

              <div>
                <div id="Field1">
                    <input id="saveForm" name="submit_book" type="submit" value="Enter Book">
                </div>
              </div>

            </form>
        
        
        </section>
        
        </div>
        
    </body>
    
</html>    