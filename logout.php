<?php

    session_start();
    $_SESSION["user_type"] = "" ;
    $_SESSION["user_id"] = "" ;
    unset($_SESSION["cart_products"]);
    echo "<script>window.location.pathname = 'cse480/Project/OBook/registration_login.php' ;</script>";
    exit;


?>