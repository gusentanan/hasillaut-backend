<?php
    require_once('./loader.php');

    use databases\DatabaseControl;
    use lib\admin\AdminAuth;
    use lib\users\UserAuth;
    use lib\users\UserData;
    use lib\admin\AdminData;
    use lib\products\Product;
    use lib\cart\Cart;
    use lib\cart\cartFeature;

    $db = new DatabaseControl();

    $userData = new UserData($db);
    $adminData = new AdminData($db);

    $user = new UserAuth($userData);
    $admin = new AdminAuth($adminData);
    $productData = new Product($db);

    // $cart = new Cart($db);
    // $users = $userData->getUserById($_SESSION['user_session']);
    // $userID = $users['user_id'];
    // $cartID = $cart->getCartID($userID);  

    $Product =  $productData->getSingleProduct();
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
    <link rel="stylesheet" href="styles/ProductInfo.css">
    
    <title>Produk</title>
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
                  <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                  <button type="submit" class="btn">
                    <i class="fas fa-search"></i>
                  </button>
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
              <a href="#notificatio">
                <img class="notification" src="styles/img/Navbar/Notification.png" alt="">
              </a>
            </div> -->
  
            <div class="navbar-nav" style="margin-right: 3%;">
              <a href="userProfile.php">
                <img class="account" src="styles/img/Navbar/Account.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </nav>

      <div class="product-info">
        <div class="container">
            <div class="row">
              <div class="col-md-7">
                <img src="images/<?php echo $Product['foto_product']?>" width="650" style="margin-left: 10%; margin-top: 1%; border-radius: 25px; width: 650px; height: 450px; margin-left: 10%; margin-top: 1%; object-fit: cover;">
                <h4>Deskripsi Produk<hr></h4> 
                <p style="line-height: 1.5; margin-left: 6%;"><?php echo $Product['desc_product']?></p> 
              </>
            </div>
            <div class="col-md-5">
                  <div class="countainer" style="border-radius: 35px;">
                      <h3><?php echo $Product['nama_product']?></h3>
                      <h6>1 kg</h6>
                      <p class="card-text fw-bold" style="font-size: 180%;" >Rp <?php echo $Product['harga_product'] ?></p>
                      
                      <a style="border-color: #4ADEDE; background-color: #4ADEDE; color: white; margin-left: 5%; " href="addToCart.php?id=<?php echo $Product['product_id'];?>" class="btn fw-bold">+Keranjang</a>
                      <a type="submit" style="border-color: #4ADEDE; background-color:white ; color: #4ADEDE;" href="addToWish.php?id=<?php echo $Product['product_id']?>" class="btn">Wishlist</a>
                  </div>
              </div>
          </div>
      </div>

      <nav class="navbar-bottom navbar-light bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-3 mt-4 mb-4" style="text-align: left;">
              <h5 class="fw-bold">HasilLaut</h5>
              <h6>Tentang HasilLaut</h6>
              <h6>Kisah HasilLaut</h6>
              <h6>Blog</h6>
              <h6>Karir</h6>
            </div>
            <div class="col-md-4 mt-4 mb-4">
              <h5 class="fw-bold">Hubungi Kami</h5>
              <h6>Kantor HasilLaut</h6>
              <h6>Jln. Belok Kanan No.2, Lurus Dikit, Sampai</h6>
              <h6>Senin - Jumat 09.30 - 18.00</h6>
              <h6>Email : contact.us@hasillaut.com</h6>
            </div>
            <div class="col-md-5 mt-4 mb-4">
              <img src="styles/img/LogoCompanyFoot.png" alt="">
            </div>
          </div>
        </div>
      </nav>
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