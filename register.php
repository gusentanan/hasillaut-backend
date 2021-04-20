<?php
    require_once "databases/DatabaseConnection.php";
    require_once "lib/auth/auth.php";


    $db = new DatabaseControl();
    $db_con = $db->getDB();

    $user = new Authentication($db_con);


    if(isset($_POST['register'])){
        $username = $_POST["username"];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        $user_con = $user->register($username, $email, $password, $first_name, $last_name);

        if($user_con){
            $success = true;
        }
        else{
            $error = $user->getLastError();
        }
    }

?>


<!DOCTYPE html>  

 <html>  
   <head> 
     <meta charset="utf-8"> 
     <title>Register</title> 
     <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8"> 
   </head> 
   <body> 
     <div class="login-page"> 
      <div class="form"> 
        <form class="register-form" method="post"> 

        <?php if (isset($error)): ?> 
          <div class="error"> 
            <?php echo $error ?> 
          </div> 
        <?php endif; ?> 

        <?php if (isset($success)): ?> 
          <div class="success"> 
            Berhasil mendaftar. Silakan <a href="login.php">login</a>. 
          </div> 
        <?php endif; ?> 

         <input type="text" name="username" placeholder="username" required/> 
         <input type="text" name="first_name" placeholder="first_name" required/> 
         <input type="text" name="last_name" placeholder="last_name" required/> 
         <input type="email" name="email" placeholder="email address" required/> 
         <input type="password" name="password" placeholder="password" required/> 
         <button type="submit" name="register">create</button> 
         <p class="message">Already registered? <a href="login.php">Sign In</a></p> 
        </form> 
      </div> 
     </div> 
   </body> 
 </html>  