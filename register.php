<?php

  require_once('./loader.php');
      
  use databases\DatabaseControl;
  use lib\users\UserAuth;
  use lib\users\UserData;

  $db = new DatabaseControl();

  $userData = new UserData($db);

  $user = new UserAuth($userData);


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
              $error = $userData->getLastError();
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
    <link rel="stylesheet" type="text/css" href="styles/register.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

    <title>HasilLaut</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body>
      <div class="row row-cols-2">
          <div class="col">
            <img src="styles/img/Navbar/Logo.png" width="350" height="350" style="margin-left: 42%; margin-top: 15%;">
            <h2 class="text-center" style="margin-left: 30%; color: #646464;">Cari Tangkapan Laut dengan Mudah Hanya di HasilLaut</h2>
            <h5 class="text-center" style="margin-left: 30%; margin-top: 3%; color: #646464;">Gabung sekarang juga!</h5>
          </div>
          <div class="col">
            <div class="container">
                <h4>Daftar Sekarang</h4>
               
                <form  method="post">
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

                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Masukkan Email">
                  </div>
                  <div class="form-group">
                    <label>Nama Depan</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Masukkan Nama Depan">
                  </div>
                  <div class="form-group">
                    <label>Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Masukkan Nama Belakang">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                  </div>
                  <button class="btn" type="submit" name="register">Selanjutnya</button> 
                  
                  <div class="text-center">
                      <label>Sudah memiliki akun? <a href="login.php">Masuk</a> </label>
                      <label>Dengan mendaftar, saya menyetujui <a href="#">Syarat dan Ketentuan</a> serta <a href="">Kebijakan Privasi</a> </label>
                  </div>
                </form>
              </div>
          </div>
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