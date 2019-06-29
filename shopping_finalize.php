<?php
    
    session_start();
    include_once("db.php");
            
        
            $grand_total = $_SESSION["total"] ;
            $user_id = $_SESSION["user_id"] ;
            
            $purchase_sql = "insert into total_purchase (purchase_total,user_id,purchase_request,delivered) values ('$grand_total','$user_id','Pending','No') " ;

                    if ($mysqli->query($purchase_sql) === TRUE ) {
                        $last_id = mysqli_insert_id($mysqli);
                                        
                        foreach ($_SESSION["cart_products"] as $cart_itm)
                        {  
                            $code = $cart_itm["book_code"] ;
                            $q = $cart_itm["product_qty"] ;
                            $totalsold = 0 ;
                            
                            $findsql = "select books_available from books where book_code = '$code' " ;
                            $result = $mysqli->query($findsql);
                            $row = $result->fetch_assoc() ;
                            
                            $available = $row["books_available"];
                            
                            $findsold = "select books_sold from books where book_code = '$code' " ;
                            $result = $mysqli->query($findsold);
                            $row = $result->fetch_assoc() ;
                            
                            $sold = $row["books_sold"];
                            $totalsold = $sold + $q ; 
                            
                            
                            $sql = "insert into buying_table (purchase_id,book_code,book_quantity) values ('$last_id','$code','$q') " ;
                            $result = $mysqli->query($sql);
                            
                            $updatesql = "update books set books_available='$available' - '$q'  where book_code = '$code' " ;
                            $mysqli->query($updatesql); 
                            
                            $updatesql = "update books set  books_sold = '$totalsold' where book_code = '$code' " ;
                            $mysqli->query($updatesql);
                            
                            echo $totalsold . " " . $available . " " . $q;
                        } 

                       unset($_SESSION["cart_products"]);
                       unset($_SESSION["total"]);
                       echo "<script>window.location.pathname = 'cse480/Project/OBook/shopping_finalize_2.php' ;</script>"; 
                    } else {
                        echo "Error: " . $purchase_sql . "<br>" . $mysqli->error;
                    }

          

?>