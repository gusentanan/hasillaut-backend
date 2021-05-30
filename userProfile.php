<?php
      require_once('./loader.php');
      
      use databases\DatabaseControl;
      use lib\users\UserAuth;
      use lib\users\UserData;
      use lib\users\UserRegister;
      use lib\users\UserUpdate;
      use lib\users\UserFeature;

      $db = new DatabaseControl();
    
      $userData = new UserData($db);
    
      $user = new UserFeature($userData);

      $users = $userData->getUserById($_SESSION['user_session']);

               
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4ecb43dae8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/ProfilUser.css">
    
    <title>HasilLaut</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="mainNav">
      <div class="container-fluid">
        <div class="navbar-nav me-4" style="margin-left: 3%;">
          <a href="homePage.php">
            <img src="styles/img/Navbar/LogoCompany.png" alt="">
          </a>
        </div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link js-scroll-trigger" href="#kategori">Kategori</a>
            </li>
          </ul>

          <form class="ms-4" style="width: 60%; margin-right: 3%;">
              <div class="input-group">
                <input type="search" class="form-control" placeholder="Cari Ikan, Udang, Cumi..." aria-label="Search">
                <a class="btn btn-primary" href="search.html" role="button"><i class="fas fa-search"></i></a>
              </div>
          </form>

          <div class="navbar-nav me-4">
            <a href="manageCart.php">
              <img class="cart" src="styles/img/Navbar/Keranjang.png" alt="">
            </a>
          </div>
          <div class="navbar-nav me-4">    
            <a href="logout.php" ><button type="button" class="add-cart">Logout</button></a>     
            </div>              

          <div class="navbar-nav ms-auto me-4">
            <a href="userWishlist.php">
              <img class="wishlist" src="styles/img/Navbar/Wishlist.png" alt="Wishlist">
            </a>
          </div>

          <!-- <div class="navbar-nav me-4">
            <a href="#notification">
              <img class="notification" src="styles/img/Navbar/Notification.png" alt="Notification">
            </a>
          </div> -->

          <div class="navbar-nav" style="margin-right: 3%;">
            <a href="userProfile.php">
              <img class="account" src="styles/img/Navbar/Account.png" alt="Account">
            </a>
          </div>
        </div>
      </div>
    </nav>

      <div style="margin-left: 5%;" class="product-info">
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div style="width: 80%;" class="btn-group-vertical">                
                <a role="button" href="userProfile.php" style="border-color: #4ADEDE; background-color: #4ADEDE; color: white;  text-align: left; " class="btn"> <i style="width: 7%; height: 50%; margin-top: 2%; margin-left: 1%;" class="fas fa-user-circle fa-lg"></i> Akun Saya</a>
                <a role="button" href="userHistory.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left;" class="btn"><i style="width: 10%; height: 50%;" class="fas fa-box-open fa-lg"></i>Pesanan</a>
                <a role="button" href="userWishlist.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left; " class="btn"><i style="width: 10%; height: 50%;" class="far fa-heart fa-lg"></i>Favorit</a>
                </div>
              </div>
              <div class="col-md-8">
                  <div class="countainer">
                      <h4>Akun Saya</h4>
                      <h6>Profil</h6>
                      <div class="wrapper">
                        <img class="circular--square" src="images/<?php echo $users['foto'] ?>"/>
                      </div>
                      <h6>Nama</h6>
                      <p class="card-text fw-bold" style="font-size: 100%;" ><?php echo $users['first_name']; echo " "; echo $users['last_name'];?></p>
                      <h6>Alamat</h6>
                      <p class="card-text fw-bold" style="font-size: 100%;" ><?php echo $users['alamat']?></p>
                      <h6>Nomer</h6>
                      <p class="card-text fw-bold" style="font-size: 100%;" ><?php echo $users['no_hp']?></p>
                      <h6>Kota Tinggal</h6>
                      <p class="card-text fw-bold" style="font-size: 100%;" ><?php echo $users['kota']?></p>
                      <h6>Provinsi</h6>
                      <p class="card-text fw-bold" style="font-size: 100%;" ><?php echo $users['provinsi']?></p>
                      <h6>Kodepos</h6>
                      <p class="card-text fw-bold" style="font-size: 100%;" ><?php echo $users['kodepos']?></p>

                      <a type="submit" style="border-color: #4ADEDE; background-color:white ; color: #4ADEDE; margin-left: 5%;" class="btn" href="userProfileEdit.php">Ubah Profile Diri</a>
                     
                  </div>
              </div>
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