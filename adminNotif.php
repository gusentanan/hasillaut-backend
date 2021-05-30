<?php  

  require_once('./loader.php');

  use databases\DatabaseControl;
  use lib\admin\AdminAuth;
  use lib\users\UserAuth;
  use lib\users\UserData;
  use lib\admin\AdminData;
  use lib\checkout\orderProduct;

  $db = new DatabaseControl();

  $userData = new UserData($db);
  $adminData = new AdminData($db);

  $user = new UserAuth($userData);
  $admin = new AdminAuth($adminData);

  $order = new orderProduct($db);

  $allOrder = $order->getOrders();
  

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
    <link rel="stylesheet" href="styles/notifadmin.css">
    
    <title>HasilLaut</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="mainNav">
      <div class="container-fluid">
        <div class="navbar-nav me-4" style="margin-left: 3%;">
          <a href="index.html">
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

          <!-- <div class="navbar-nav me-4">
            <a href="login.html">
              <img class="cart" src="img/Navbar/Keranjang.png" alt="">
            </a>
          </div>              

          <div class="navbar-nav ms-auto me-4">
            <a href="login.html">
              <img class="wishlist" src="img/Navbar/Wishlist.png" alt="Wishlist">
            </a>
          </div> -->

          <div class="navbar-nam me-4">
          <a href="logout.php"><button type="button">Logout</button></a>     
          </div>
          <div class="navbar-nav me-4">
            <a href="adminNotif.php">
              <img class="notification" src="styles/img/Navbar/Notification.png" alt="Notification">
            </a>
          </div>

          <div class="navbar-nav" style="margin-right: 3%;">
            <a href="adminPage.php">
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
                  <a role="button" href="adminPage.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE;  text-align: left; " class="btn"> <i style="width: 7%; height: 50%; margin-top: 2%; margin-left: 1%;" class="fas fa-user-circle fa-lg"></i> Akun Saya</a>
                  <a role="button" href="manageProduct.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left;" class="btn"><i style="width: 10%; height: 50%;" class="fas fa-box-open fa-lg"></i>Kelola Produk</a>
                  <a role="button" href="addProduct.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left;" class="btn"><i style="width: 10%; height: 50%;" class="far fa-plus-square"></i>Tambah Produk</a>
                  <a role="button" href="adminNotif.php" style="border-color: #4ADEDE; background-color: #4ADEDE; color: white; margin-top: 4%;   text-align: left; " class="btn"><i style="width: 10%; height: 50%;" class="far fa-heart fa-lg"></i>Notifikasi</a>
                </div>
            </div>
              <div class="col-md-8">
                  <div class="countainer">
                      <h4>Notifikasi Pesanan</h4>
                <?php  while($orderan = mysqli_fetch_array($allOrder)){ ?>
                      <div class="card mb-3" style="max-width: 700px;">
                        <div class="row g-0">
                          <div class="col-md-2">
                            <img src="styles/img/Product/shanon.jpg" alt="...">
                          </div>
                          <div class="col-md-6">
                            <div class="card-body">
                              <h6 class="card-title"><b><?php echo $orderan['product_order']?></b></h6>
                              <p class="card-text"><small class="text-muted">Total Harga : Rp <?php echo $orderan['total_order']?> </small></p>
                              <p class="card-text"><small>Total Barang: <?php echo $orderan['total_quantity']?></small></p>
                            </div>
                          </div>
                          <div class="col-md-4 my-auto"><b></b></div>
                        </div>
                      </div> 
                <?php } ?>
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