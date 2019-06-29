<?php

    session_start();

?>


<?php

        include 'db.php';


        $fname = $lname = $nameErr = $emailErr = $email = $password = $passworderr = $phoneerr = $phone = $addresserr = $address = $genderErr = $gender = $birthdate = $login_mail_err = $login_password_err = $login_mail = $login_password = "" ;

        $flag = $accepted = $pending = $blocked = 0 ;


        if(isset($_POST['action']))
        { 


            if($_POST['action']=="signup") {
              if (empty($_POST["fname"]) || empty($_POST["lname"])) {
                $nameErr = "Name is required";
                $flag = 1 ;
              } else {
                $fname = test_input($_POST["fname"]);
                $lname = test_input($_POST["lname"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$fname) | !preg_match("/^[a-zA-Z ]*$/",$fname)) {
                  $nameErr = "Only letters and white space allowed";
                  $flag = 1 ;  
                }
              }

              if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                $flag = 1 ;  
              } else {
                  $email = test_input($_POST["email"]);
                  $query = "SELECT email FROM  	registratedusers where email='".$email."'";
                  $result = mysqli_query($mysqli ,$query);
                  $numResults = mysqli_num_rows($result);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format";
                  $flag = 1 ;  
                }
                elseif($numResults>=1)
                {
                   $emailErr = "Email already exist!!";
                   $flag = 1 ;  
                }
                  
              }
                
             if (empty($_POST["password"])) {
                $passworderr  = "Password cant be empty";
                $flag = 1 ; 
              } else {
                $password = test_input($_POST["password"]);
              }             
        
                if (empty($_POST["mobileno"])) {
                $phoneerr  = "Mobile Number cant be empty";
                 $flag = 1 ;   
              } else {
                $phone = test_input($_POST["mobileno"]);
              }
                

              if (empty($_POST["address"])) {
                $addresserr = "Address Cant be empty!";
                $flag = 1 ;  
              } else {
                $address = test_input($_POST["address"]);

              }
        
              if (empty($_POST["birthdate"])) {
                $birthdate = "";
              } else {
                $birthdate = test_input($_POST["birthdate"]);

              }

              if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
                $flag = 1 ;  
              } else {
                $gender = test_input($_POST["gender"]);
              }

                
            if($flag == 0){
                $sql = "INSERT INTO registratedusers (fname, lname, email,password,mobileno,address,date,gender)
               VALUES ('$fname', '$lname', '$email','$password','$phone','$address','$birthdate','$gender')";

                if ($mysqli ->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli ->error;
                } 
            }

         }
        
        elseif($_POST['action']=="login"){
            $check = 0 ;                
            if(empty($_POST["login_mail"])){
                $login_mail_err = "Give Email Address Please" ; 
                $check = 1 ;
            } 
            elseif (!filter_var($_POST["login_mail"], FILTER_VALIDATE_EMAIL)) {
                $login_mail_err = "Invalid Email Address " ;
                $check = 1 ;
            }
            else{
                
                $login_mail = test_input($_POST["login_mail"]) ; 

            }
                
            if(empty($_POST["login_password"])){
                $login_password_err = "Give Password Please" ;
                $check = 1 ;
            }    
            else{
                
                $login_password = test_input($_POST["login_password"]) ; 

            }

            if($check == 0 ){
                
                $strSQL = mysqli_query($mysqli ,"select * from registratedusers where Request = 'Accepted' and  Email='".mysqli_real_escape_string ($mysqli ,$login_mail)."' and password='".mysqli_real_escape_string ($mysqli ,$login_password)."'");
                
                if($strSQL == TRUE ){
                    
                     
                     $Results = mysqli_fetch_array($strSQL);

                    if(count($Results)>=1)
                    {   
                        $accepted = 1;    
                        if($Results["user_type"] == "admin" ){
                            $_SESSION["user_id"]=$Results["user_id"] ;
                            $_SESSION["user_type"]= "admin" ;
                            //echo $_SESSION["user_id"] ;
                            //echo $_SESSION["user_type"] ;
                            echo "<script type='text/javascript'>  window.location=' admin/admin_page.php'; </script>";
                            
                        }
                        else if($Results["user_type"] == "buyer" ){
                            $_SESSION["user_id"]=$Results["user_id"] ;
                            $_SESSION["user_type"]= "buyer" ;
                            echo "<script type='text/javascript'>  window.location=' account.php'; </script>";
                            
                        }
                        
                    }

                    
                }
                
                 if($accepted!=1){
                    
                    $strSQL2 = mysqli_query($mysqli ,"select * from registratedusers where Request = 'Blocked' and   Email='".mysqli_real_escape_string ($mysqli ,$login_mail)."' and password='".mysqli_real_escape_string ($mysqli ,$login_password)."'");
                     
                    if(mysqli_num_rows ($strSQL2)>0){
                    
                        $blocked = 1 ;
                        echo "You are blocked!";
                    
                    } 
                }
            
               if($accepted != 1 && $blocked != 1 ){
                    
                    $strSQL3 = mysqli_query($mysqli ,"select * from registratedusers where Request = 'Pending' and  Email='".mysqli_real_escape_string ($mysqli ,$login_mail)."' and password='".mysqli_real_escape_string ($mysqli ,$login_password)."'");
                    
                    if(mysqli_num_rows ($strSQL3)>0){
                        $pending = 1 ;
                        echo "You Request is on pending..Wait for confirmation!";
                    }
                }
                
                if($accepted != 1 && $blocked != 1 && $pending != 1)
                {
                    echo "Invalid email or password!!";
                } 
            }

          }

        }
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }  

        $mysqli ->close();


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
                    <li><a href="#">Support</a></li>
                    <li><a href="#">About Us</a></li>
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
        <div class="form">
 

            <div id="signup"> 
                <h1>Account Sign Up</h1>
               <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <ul class="form-style-1">
                    <li><label>Full Name <span class="required">* <?php echo $nameErr ; ?></span></label><input type="text" name="fname" class="field-divided" placeholder="First" />&nbsp;<input type="text" name="lname" class="field-divided" placeholder="Last" /></li>
                    <li>
                        <label>Email <span class="required">* <?php echo $emailErr ; ?></span></label>
                        <input type="email" name="email" class="field-long" />
                    </li>
                    <li>
                        <label>Password <span class="required">* <?php echo $passworderr ; ?></span></label>
                        <input type="password" name="password" class="field-long" />
                    </li>                    
                   
                    <li>
                        <label>Mobile No <span class="required">* <?php echo $phoneerr ; ?></span></label>
                        <input type="text" name="mobileno" class="field-long" />
                    </li>
                    <li>
                        <label>Address <span class="required">* <?php echo $addresserr ; ?></span></label>
                        <input type="text" name="address" class="field-long" />
                    </li>                    
                    <li>
                        <label>Date of Birth </label>
                        <input type="date" name="birthdate" class="field-long" />
                    </li>
                    <li>
                        <label>Gender <span class="required">* <?php echo $genderErr ; ?></span></label>
                        <input type="radio" name="gender"  value="Male" /> Male
                        <input type="radio" name="gender"  value= "Female" />Female
                         <input name="action" type="hidden" value="signup" />
                    </li>

                    <li>
                        <input type="submit" value="Submit" name="submit" />
                    </li>
                </ul>
            </form>
           </div>    

            <div id="login">   
                <h1>Welcome Back!</h1>

                <form method="post">
                <ul class="form-style-1">

                    <li>
                        <label>Email <span class="required">* <?php echo $login_mail_err ; ?></span></label>
                        <input type="email" name="login_mail" class="field-long" />
                    </li>
                     <li>
                        <label>Password <span class="required">* <?php echo $login_password_err ; ?></span></label>
                        <input type="password" name="login_password" class="field-long" />
                          <input name="action" type="hidden" value="login" />
                    </li>
              
                    <li>
                        <input type="submit" name ="login_submit" value="Submit" />
                    </li>
                </ul>
                </form>

                </div>    
           </div>    
      </div>    
    </body>
</html>

