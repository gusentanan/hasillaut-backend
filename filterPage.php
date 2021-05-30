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

    $user = new UserAuth($userData);
    $admin = new AdminAuth($adminData);
    $productData = new Product($db);

    $specificProduct =  $productData->getProductByKategori();

    $kategori = $_GET['id'];
    $kategoriData = $productData->getKategoriByID($kategori);


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

    <title>#Category</title>
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

    <div class="product-category">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h5 class="fw-bold" style="margin-bottom: 13%;">Filter Harga</h5>
                    
                    <div class="price-min mb-3">
                        <div class="input-group">
                            <div class="harga">
                                <form method="post">
                                <div class="col">
                                    <div class="dropdown">
                                        <select class="btn btn-secondary dropdown-toggle" name="filter">
      
                                          <option value="">Pilih Filter</option>
                                          <option value="range1">Termahal</option>
                                          <option value="range2">Termurah</option>
                                          <option value="range3">Termurah - Rp.10.000</option>
                                          <option value="range4">Rp. 10.000 - Rp.20.000</option>
                                          <option value="range5">Rp. 20.000 - Termahal</option>
                                        </select>
                                        <br><br>
                                    <button type="submit" class=" btn fw-bold">Apply</button>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_POST['filter']) == ''){
                                        $_POST['filter'] = NULL;
                                    }
                                    elseif(isset($_POST['filter'])) {	
                                        if($_POST['filter']=='range1'){
                                            
                                            $qry = "SELECT * FROM product WHERE kategori_product = '$kategori' ORDER BY harga_product DESC";
                                            $resFilter = $productData->getProductByFilter($qry);
                                        }
                                        if($_POST['filter']=='range2'){

                                            $qry = "SELECT * FROM product WHERE kategori_product = '$kategori' ORDER BY harga_product ASC";
                                            $resFilter = $productData->getProductByFilter($qry);
                                        }
                                        if($_POST['filter']=='range3'){
                                            $low = 0; $high = 10000;
                                            $qry = "SELECT * FROM product WHERE kategori_product = '$kategori' AND harga_product BETWEEN $low AND $high";
                                            $resFilter = $productData->getProductByFilter($qry);
                                        } 
                                        if($_POST['filter']=='range4'){
                                            $low = 10000; $high = 20000;
                                            $qry = "SELECT * FROM product WHERE kategori_product = '$kategori' AND harga_product BETWEEN $low AND $high";
                                            $resFilter = $productData->getProductByFilter($qry);
                                        } 
                                        if($_POST['filter']=='range5'){
                                            $low = 20000; $high = 99999;
                                            $qry = "SELECT * FROM product WHERE kategori_product = '$kategori' AND harga_product BETWEEN $low AND $high";
                                            $resFilter = $productData->getProductByFilter($qry);
                                        } 
                                    }
                                ?>
                              </form>
                                
                            </div>
                        </div>
                    </div>                       
                    
                </div>
                <div class="col-md-10">
                    <div class="card-product-category">
                        <div class="container">
                            <div class="row row-cols-2">
                                <div class="col">
                                    <h5 class="fw-bold">#<?php echo $kategoriData['nama_kategori']?> </h5>
                                    <br>
                                </div>
                            </div>
                        <div class="row row-cols-5">
                        <?php if(isset($_POST['filter'])){ ?>
                            <?php while($product = mysqli_fetch_array($resFilter)){ ?>
                            <div class="col">
                                <div class="card">
                                <img src="images/<?php echo $product['foto_product']?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $product['nama_product']?></h6>
                                    <p class="card-text fw-bold">Rp <?php echo $product['harga_product']?><small class="fw-normal"> / weight</small></p>               
                                    <a href="addToCart.php?id=<?php echo $product['product_id'];?>" class="add-cart btn fw-bold">+Keranjang</a>
                                    <a href="detailsProduct.php?id=<?php echo $product['product_id']?>" class="details btn fw-bold">Detail</a>
                                </div>
                                </div>
                            </div>
                            <?php } ?>  
                    <?php
                        } 
                        else{ ?>

                            <?php while($product = mysqli_fetch_array($specificProduct)){ ?>
                            <div class="col">
                                <div class="card">
                                <img src="images/<?php echo $product['foto_product']?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $product['nama_product']?></h6>
                                    <p class="card-text fw-bold">Rp <?php echo $product['harga_product']?><small class="fw-normal"> / weight</small></p>               
                                    <a href="addToCart.php?id=<?php echo $product['product_id'];?>" class="add-cart btn fw-bold">+Keranjang</a>
                                    <a href="detailsProduct.php?id=<?php echo $product['product_id']?>" class="details btn fw-bold">Detail</a>
                                </div>
                                </div>
                            </div>
                            <?php } ?>  

                        <?php } ?>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <br><br>
    <br><br>
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