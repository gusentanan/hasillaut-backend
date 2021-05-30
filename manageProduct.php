<?php  

  require_once('./loader.php');

  use databases\DatabaseControl;
  use lib\admin\AdminAuth;
  use lib\users\UserAuth;
  use lib\users\UserData;
  use lib\admin\AdminData;
  use lib\products\Product;

  $db = new DatabaseControl();

  $userData = new UserData($db);
  $adminData = new AdminData($db);
  $productData = new Product($db);
  
  $user = new UserAuth($userData);
  $admin = new AdminAuth($adminData);
  
  $adminProduct =  $productData->getProductByIdAdmin($_SESSION['user_session']);
  $totalInventory = $productData->totalInventory();
  ?> 

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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

    <title>Produk Admin</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body id="landing-page">
    
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="mainNav">
      <div class="container-fluid">
        <div class="navbar-nav me-4" style="margin-left: 3%;">
          <a href="adminPage.php">
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

    <tbody>
       <div class="cart overflow-hidden">
        <div class="row">
            <div class="col-md-3"><div class="subtotal" style="margin-top: 30%; margin-left:20%;">
                    <h4>Total Produk</h4>
                  <div class="row row-cols-2">
                      <div class="col">
                      <?php while($hehe = mysqli_fetch_array($totalInventory)){ ?>
                          <h10 class="fw-bold"><?php echo $hehe['nama_kategori']?></h10>
                          <p class="card-text"><small class="text-muted">Rp <?php echo $hehe['total_harga']?></small></p>
                          
                      <?php } ?>
                      </div>
                  </div>
                  </div>
                </div>
               <div class="col-md-6">
                  <div class="container overflow-auto">
                    <br>
                  <?php while($product = mysqli_fetch_array($adminProduct)){ ?>
                                
                                  <div class="card mb-3">
                                    <div class="row g-0">
                                      <div class="col-md-2">
                                        <div class="card">
                                        <img src="images/<?php echo $product['foto_product']?>" alt="...">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="card-body">
                                          <small class="card-title"><b><?php echo $product['nama_product']?></b></small>
                                          <p class="card-text"><small class="text-muted">Rp <?php echo $product['harga_product']?> / 1 kg</small></p>
                                          <p class="card-text"><small><b>Rp <?php echo $product['harga_product']?></b></small></p>
                                        </div>
                                      </div>
                                      <div class="col-md-4 my-auto">
                                      <a href="updateProduct.php?id=<?php echo $product['product_id'];?>"  class="btn">Edit Produk</a>                  
                                      <a href="#modal-delete-<?php echo $product['product_id'] ?>" data-toggle="modal" data-target="#modal-delete-<?php echo $product['product_id'] ?>"  class="btn btn-danger">Hapus</a>

                                          <div id="modal-delete-<?php echo $product['product_id'] ?>" class="modal fade">
                                            <div class="modal-dialog modal-confirm">
                                              <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                  <div class="icon-box">
                                                    <i class="material-icons">&#xE5CD;</i>
                                                  </div>						
                                                  <h4 class="modal-title w-100">Anda Yakin?</h4>	
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                      <p>Apakah Anda Yakin Menghapus Produk <strong><?php echo $product['nama_product']?></strong> ? </p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                <a href="delete.php?id=<?php echo $product['product_id'];?>" class="btn btn-danger">Hapus</a>
                                                      <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>     

          


                                      </div>
                                    </div>
                        </div>
                        <?php
                            }
                          ?>  
                  </div>
                  <div class="subtotal">
                  <div class="row row-cols-2">
                      <div class="col">
                      
                      </div>
                      <div class="col">
                          <div class="check-out">
                              <a class="btn" href="adminPage.php" role="button"><b>Kembali</b></a>
                          </div>                                    
                      </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-3"></div>
            </div>  
          </div>
          <br>
            
        </tbody>
       
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