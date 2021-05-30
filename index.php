<?php  

  require_once('./loader.php');

  use databases\DatabaseControl;
  use lib\admin\AdminAuth;
  use lib\users\UserAuth;
  use lib\users\UserData;
  use lib\admin\AdminData;

  $db = new DatabaseControl();

  $userData = new UserData($db);
  $adminData = new AdminData($db);

  $user = new UserAuth($userData);
  $admin = new AdminAuth($adminData);


      if(!$user->isLoggedIn()){ 

        header("location: login.php"); //Redirect ke halaman login 
        
      } 
      else{
          $currentUser = $user->getUserData();

          if($currentUser){
            header("location: homePage.php");
          }
          else{
            header("location: adminPage.php");
          }
      }


  ?> 

