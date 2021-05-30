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

    if ($user->isLoggedIn()) {
        header("location: index.php"); //redirect ke index 

    }

    if (isset($_POST['just_do_it'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userValidation = $userData->getUserByUsername($username);
        $adminValidation = $adminData->getAdminUsername($username);

        if($userValidation){
            $user_con = $user->login($username, $password);
            if($user_con){
                header("location: index.php");
            }
            else{
                $error = $user->getLastError();
            }
        }
        else if($adminValidation){
            $admin_con = $admin->login($username, $password);
            if($admin_con){
                header("location: index.php");
            }
            else{
                $error = $admin->getLastError();
            }
        }
        else{
            $error = "Username dan Password Anda Salah!";
        }
    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

    <title>HasilLaut</title>
    <link rel="icon" href="img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body>
    <div class="container">
        <img src="styles/img/Navbar/Logo.png" width="200" height="200" style="margin-left: 23%;" >
        <h4>Masuk</h4>
  
        <form method="post">
          <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>
           <?php endif; ?>

          <div class="form-group">
            <label>Username</label>
            <input type="username" name="username" class="form-control" placeholder="Masukkan Username" required/>
          </div>
  
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required/>
          </div>
          
           <button class="btn" type="submit" name="just_do_it">Selanjutnya</button>
           
          <div style="text-align: center;">
            <label>Belum memiliki akun? <a href="register.php">Daftar sekarang</a> </label>
          </div>
        </form>
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>