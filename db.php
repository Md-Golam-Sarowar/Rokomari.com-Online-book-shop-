<?php


$currency = 'Tk '; //Currency Character or code

$db_username = 'root';
$db_password = '';
$db_name = 'project_book_shopping';
$db_host = 'localhost';


$taxes  = array( //List your Taxes percent here.
                            'VAT' => 12, 
                            'Service Tax' => 5
                            );						
        //connect to MySql						
     $mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
        if ($mysqli->connect_error) {
            die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }


     if(!isset($_SESSION["user_type"]) ){
         $_SESSION["user_type"] = "" ;
     }

    if(!isset($_SESSION["user_id"]) ){
         $_SESSION["user_id"] = "" ;
     }

    
?>
