<?php

    require_once('./loader.php');

    use databases\DatabaseControl;
    use lib\admin\AdminAuth;
    use lib\users\UserAuth;
    use lib\users\UserData;
    use lib\admin\AdminData;
    use lib\products\Product;
    use lib\cart\Cart;
    use lib\checkout\orderFeature;
    use lib\checkout\orderProduct;

    $db = new DatabaseControl();

    $cart = new Cart($db);

    $users = new UserData($db);

    $order = new orderProduct($db);

    $orderAction = new orderFeature($order);

    $userData = $users->getUserById($_SESSION['user_session']);
    $userID = $userData['user_id'];
    

    $cartID = $cart->getCartID($userID);

    $cartData = $cart->getAllCartItem($cartID['cart_id']);

    $cartMain = $cart->getCartMain($cartID['cart_id']);

    if(isset($_POST['order'])){
        
        $cart_id = $_POST['cart_id'];
        $product = $_POST['product'];
        $alamat = $_POST['alamat_order'];
        $tanggal_order = $_POST['order_date'];
        $total_order = $_POST['total_order'];
        $total_barang = $_POST['total_quan'];
        $order_via = $_POST['radio'];

        

        $res =  $orderAction->checkoutOrder($cart_id, $product, $alamat, $tanggal_order, $total_order, $total_barang, $order_via);
        if($res){
            header("location: userCheckout.php");
            
        }

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS Offline-->
    <link rel="stylesheet" type="text/css" href="styles/css/bootstrap.min.css">
    <!-- Bootstrap CSS Online-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">-->

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="styles/style.css">

    <!-- Font AWESOME Offline -->
    <link rel="stylesheet" href="styles/fontawesome-free/css/all.min.css">
    <!-- Font AWESOME Online
    <script src="https://kit.fontawesome.com/4ecb43dae8.js" crossorigin="anonymous"></script> -->

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <title>Checkout</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body id="landing-page">
    
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
            <a href="">
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

    
    <div class="checkout overflow-hidden">
      <div class="container">
        <div class="row">
            <form class="row" method="post" enctype="multipart/form-data"> 
                <div class="col-md-6">
                    <div class="address-bar container">
                    <div class="row">
                        <div class="col-md-4">
                        <p>Alamat Pengiriman</p>
                        </div>
                        <div class="col-md-8">
                        <input type="text" name="alamat_order" placeholder="Masukkan Alamat Pengiriman" required/>
                        </div>
                    </div>
                    </div>
                    <div class="cart container overflow-auto">
                    <br>
                    <?php while($data = mysqli_fetch_array($cartData)){ ?>
                        
                        <?php $Items[] = $data['nama_product']; 
                        ?>

                        <div class="card mb-3" style="max-width: 700px;">
                            <div class="row g-0">
                            <div class="col-md-2">
                                <img src="images/<?php echo $data['foto_product']?>" alt="...">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                <small class="card-title"><b><?php echo $data['nama_product'] ?></b></small>
                                <p class="card-text"><small class="text-muted">Rp <?php echo $data['harga_product']?> / kg</small></p>
                                <p class="card-text"><small>Quantity : <?php echo $data['quantity']?></small></p>
                                </div>
                            </div>
                            <div class="col-md-4 my-auto"><b>Rp <?php echo $data['harga_product']* $data['quantity']?></b></div>
                            </div>
                        </div> 
                        
                    <?php  $allItems = implode(', ', $Items);?>
                        
                            <input type="hidden" id="cart_id" name="cart_id"  value="<?php echo $data['cart_id']?>"/>
                            <input type="hidden" id="product" name="product"  value="<?php echo $allItems?>"/>
                            <input type="hidden" id="order_date" name="order_date"  value="<?php echo date("Y-m-d"); ?>"/>
                            <input type="hidden" id="total_order" name="total_order"  value="<?php echo $cartMain['totalHarga']?>"/>
                            <input type="hidden" id="total_quan" name="total_quan"  value="<?php echo $cartMain['totalBarang']?>"/>
                    
                            <?php } ?>    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="payment container">
                    <br>
                    <h5><b>Rincian Pembayaran</b></h5>
                        <p>Total Belanja
                        <b>Rp <?php echo $cartMain['totalHarga']?></b></p>
                        <hr>
                        <p>Ongkos Kirim
                        <b>Gratis Ongkir</b></p>
                        <hr>
                        <p>Total Pembayaran
                        <b>Rp <?php echo $cartMain['totalHarga']?></b></p>
                        <hr>
                        <h5><b>Metode Pembayaran</b></h5>
                        
                            <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="radio" id="conveniencestore" value="conveniencestore">
                            <label class="form-check-label" for="conveniencestore">
                                Convenience Store
                            </label>
                            </div>
                            <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="radio" id="e-banking" value="e-banking">
                            <label class="form-check-label" for="e-banking">
                                E-Banking
                            </label>
                            </div>
                            <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="radio" id="e-wallet" value="e-wallet">
                            <label class="form-check-label" for="e-wallet">
                                E-Wallet
                            </label>
                            </div>
                            
                        <div class="pay">
                        <button class="btn" type="submit" name="order">Bayar</button>
                        </div> 
                    </div>
                </div>
            </form>
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

    <!--Bootstrap JavaScript Offline-->
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
    <!--Bootstrap JavaScript Online-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>