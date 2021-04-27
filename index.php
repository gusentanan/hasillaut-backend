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

      // Ambil data user saat ini 
      $currentUser = $user->getUserData();
      if($currentUser == false){
        $currentUser = $admin->getAdminData();
      }

  ?> 

 <!DOCTYPE html>  

 <html>  
   <head> 
     <meta charset="utf-8"> 
     <title>Home</title> 
     <link rel="stylesheet" href="styles/style.css" media="screen" title="no title" charset="utf-8"> 
   </head> 
   <body> 
     <div class="container"> 
       <div class="info"> 
        
        <?php if (isset($currentUser['admin_id'])): ?>
          <h1>Selamat datang Admin <?php echo $currentUser['username_admin'] ?></h1> 
        <?php else: ?>
          <h1>Selamat datang <?php echo $currentUser['first_name'] ?></h1> 
          <a href="userProfile.php"><button type="button">Profile</button></a> 
        <?php endif; ?>

       </div> 
       <a href="logout.php"><button type="button">Logout</button></a> 
     </div> 
   </body> 

 </html>  