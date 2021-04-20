<?php  

    require_once "databases/DatabaseConnection.php";
    require_once "lib/auth/auth.php";

    $db = new DatabaseControl();
    $db_con = $db->getDB();

    $user = new Authentication($db_con);

    if(!$user->isLoggedIn()){ 

      header("location: login.php"); //Redirect ke halaman login 

    } 

    // Ambil data user saat ini 
    $currentUser = $user->getUserData(); 

  ?> 

 <!DOCTYPE html>  

 <html>  
   <head> 
     <meta charset="utf-8"> 
     <title>Home</title> 
     <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8"> 
   </head> 
   <body> 
     <div class="container"> 
       <div class="info"> 
        
        <?php if (isset($currentUser['admin_id'])): ?>
          <h1>Selamat datang <?php echo $currentUser['username_admin'] ?></h1> 
        <?php else: ?>
          <h1>Selamat datang <?php echo $currentUser['first_name'] ?></h1> 
        <?php endif; ?>

       </div> 
       <a href="logout.php"><button type="button">Logout</button></a> 
     </div> 
   </body> 

 </html>  