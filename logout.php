<?php
   require_once "databases/DatabaseConnection.php"; 
   require_once "lib/auth/auth.php";
    // Logout! hapus session user 



    $db = new DatabaseControl();
    $db_con = $db->getDB();

    $user = new Authentication($db_con);
    
    $user->logout();

    header('location: login.php'); 

?> 