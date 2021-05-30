<?php
    require_once('./loader.php');

    use databases\DatabaseControl;
    use lib\admin\AdminAuth;
    use lib\users\UserAuth;
    use lib\users\UserData;
    use lib\admin\AdminData;
    use lib\cart\Cart;
    use lib\products\Product;

    $db = new DatabaseControl();

    $cart = new Cart($db);

    $users = new UserData($db);

    $userData = $users->getUserById($_SESSION['user_session']);
    $userID = $userData['user_id'];
    

    $cartID = $cart->getCartID($userID);

    $cartData = $cart->getAllCartItem($cartID['cart_id']);

    $cartMain = $cart->getCartMain($cartID['cart_id']);


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

    <title>Keranjang Saya</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <div id="landing-page">
    
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
    <div class="cart overflow-hidden">
      <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
            <div class="container overflow-auto">
                <br>
            <?php while($data = mysqli_fetch_array($cartData)){ ?>
                
                <div class="card mb-3" style="max-width: 700px;">
                <div class="row g-0">
                    <div class="col-md-2">
                    <img src="images/<?php echo $data['foto_product']?>" alt="...">
                    </div>
                    <form method="post" class="col-md-6">
                    <div class="card-body">
                        <small class="card-title"><b><?php echo $data['nama_product']?></b></small>
                        <p class="card-text"><small class="text-muted">Rp <?php echo $data['harga_product']?> / x kg</small></p>
                        <p class="card-text"><small><b>Rp <?php echo $data['harga_product']?></b></small></p>
                    </div>
                    </form>
                    <form method="post" class="col-md-4 my-auto">
                        <label for="">Quantity :</label>    

                        <input class="quantity" type="number" name="quantity" value="<?php echo $data['quantity']?>" min="1">
                        <input type="hidden" name="key" value="<?php echo $data['product_id']?>">   
                        <button type="submit" class="btn" name="update">Save</button>
                    </form>
                    <?php  if(isset($_POST['update'])){
                            $quantity = $_POST['quantity']; 
                            $productID = $_POST['key'];
                            // echo $quantity;
                            // echo $productID;
                            $cart->updateQuantity($quantity, $productID, $data['cart_id']);
                        } ?>
                    

                    <form method="post" class="col-md-8">
                    <input type="hidden" name="pKey" value="<?php echo $data['product_id']?>">
                    <input type="hidden" name="cKey" value="<?php echo $data['cart_id']?>">
                    <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                    </form>
                    <?php  if(isset($_POST['delete'])){
                            $pID = $_POST['pKey']; 
                            $cID = $_POST['cKey'];
                            // echo $cID;
                            // echo $pID;
                            $cart->deleteItem($cID, $pID);
                        } ?>
                    <div><br></div>
                </div>
                </div>    
                <?php
                    }
                ?> 
             </div>
                  <div class="subtotal">
                  <div class="row row-cols-2">
                      <div class="col">
                          <h5 class="fw-bold">Subtotal</h5>
                          <small class="hasil"><b>Rp.</b><b><?php echo $cartMain['totalHarga']?></b></small>
                      </div>
                      <div class="col">
                          <div class="check-out">
                              <a class="btn" href="userCheckout.php" role="button"><b>Checkout</b></a>
                          </div>                                    
                      </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-3"></div>
            </div>  
          </div>
          <br>
      
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