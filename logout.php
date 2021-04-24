<?php

    require_once('./loader.php');
    
    use databases\DatabaseControl;
    use lib\users\UserAuth;
    use lib\users\UserData;
    
    $db = new DatabaseControl();
    
    $userData = new UserData($db);
    
    $user = new UserAuth($userData);
    
    $user->logout();

    header('location: login.php'); 

?> 