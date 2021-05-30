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

    $cart = new Cart($db);
    $users = $userData->getUserById($_SESSION['user_session']);
    $userID = $users['user_id'];
    $cartID = $cart->getCartID($userID);  

    $allProduct =  $productData->getAllProduct();
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

            <form class="ms-4" style="width: 60%; margin-right: 3%;" method="post">
                <div class="input-group">
                  <input name="search" type="search" class="form-control" placeholder="Cari Ikan, Udang, Cumi..." aria-label="Search">
                  <button type="submit" name="search-eng" class="btn">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
                <?php
                  if(isset($_POST['search-eng'])){
                      $search = $_POST['search'];
                      $resSearch = $productData->getProductBySearch($search);
                  }
                ?>
            </form>

            <div class="navbar-nav me-4">
              <a href="manageCart.php">
                <img class="cart" src="styles/img/Navbar/Keranjang.png" alt="">
              </a>
            </div>   
            <div class="navbar-nav me-4">    
            <a href="logout.php" ><button type="button" class="add-cart">Logout</button></a>     
            </div>
            <!-- <div class="navbar-nav ms-auto me-4">
              <a href="#wishlist">
                <img class="wishlist" src="img/Navbar/Wishlist.png" alt="Wishlist">
              </a>
            </div>

            <div class="navbar-nav me-4">
              <a href="#notification">
                <img class="notification" src="img/Navbar/Notification.png" alt="Notification">
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
    <div class="container">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="margin-top: 6%;">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="styles/img/Carousel/sc1.jpg" class="showcase" alt="...">
          </div>
          <div class="carousel-item">
            <img src="styles/img/Carousel/sc2.jpeg" class="showcase" alt="...">
          </div>
          <div class="carousel-item">
            <img src="styles/img/Carousel/sc3.jpg" class="showcase" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    
    <div class="card-category">
      <div class="container" style="margin-top: 4%;">
        <h5 class="fw-bold" sty>Kategori</h5>
        <div class="row row-cols-8">
          <div class="col">
            <div class="card">
              <img src="styles/img/Category/Kepiting.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text text-center"><a href="filterPage.php?id=1" class="btn fw-bold">Tangkapan</a></p>
              </div>
            </div>
          </div>
  
          <div class="col">
            <div class="card">
              <img src="styles/img/Category/fish-s.png" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text text-center"><a href="filterPage.php?id=2" class="btn fw-bold">Olahan</a></p>
              </div>
            </div>
          </div>
  
          <div class="col">
            <div class="card">
              <img src="styles/img/Category/cumi.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text text-center"><a href="filterPage.php?id=3" class="btn fw-bold">Cumi</a></p>
              </div>
            </div>
          </div>
  
          <div class="col">
            <div class="card">
              <img src="styles/img/Category/Kepiting.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text text-center"><a href="filterPage.php?id=4" class="btn fw-bold">Bercangkang</a></p>
              </div>
            </div>
          </div>
  
          <div class="col">
            <div class="card">
              <img src="styles/img/Category/telur ikan.jpg" class="card-img-top" alt="...">
              <div class="card-body">
              <p class="card-text text-center"><a href="filterPage.php?id=5" class="btn fw-bold">Unik</a></p>
              </div>
            </div>
          </div>
  
          <div class="col">
            <div class="card">
              <img src="styles/img/Product/olahan.png" class="card-img-top" alt="...">
              <div class="card-body">
                 <a href="filterPage.php?id=6" class="btn fw-bold">Tumbuhan</a>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
              <img src="styles/img/Category/fish-s.png" class="card-img-top" alt="...">
              <div class="card-body">
                 <a href="filterPage.php?id=7" class="btn fw-bold">Ikan Laut</a>
              </div>
            </div>
          </div>

          

        </div>
      </div>
    </div>
    <!--START  All Product Tangkapan  -->
    <div class="card-product-tangkapan">
      <div class="container" style="margin-top: 4%;">
        <h5 class="fw-bold"> Produk  <small><a class="fw-normal ms-2" href=""> Lihat Semua</a></small></h5>
                <?php if(isset($_POST['harga']) || isset($_POST['kategori'])){ ?>
                    <div class="row row-cols-6">
                        <?php  while($product = mysqli_fetch_array($resFilter)){ $nomor++; ?>
                                    <div class="col">
                                        <div class="card">
                                            <img src="images/<?php echo $product["foto_product"]; ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo $product["nama_product"];   ?></h6>
                                                <p class="card-text fw-bold"><?php echo 'Rp.'.$product["harga_product"];   ?><small class="fw-normal"> / kg</small></p>               
                                                <a href="addToCart.php?id=<?php echo $product['product_id'];?>" class="add-cart btn fw-bold">+Keranjang</a>
                                                <a href="detailsProduct.php?id=<?php echo $product['product_id']?>" class="details btn fw-bold">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                          <?php  } ?>
                    </div>
                <?php }
                elseif(isset($_POST['search-eng'])){ ?>
                    <div class="row row-cols-6">
                        <?php  while($product = mysqli_fetch_array($resSearch)){ ?>
                                <div class="col">
                                    <div class="card">
                                        <img src="images/<?php echo $product["foto_product"]; ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h6 class="card-title"><?php echo $product["nama_product"];   ?></h6>
                                            <p class="card-text fw-bold"><?php echo 'Rp.'.$product["harga_product"];   ?><small class="fw-normal"> / kg</small></p>               
                                            <a href="addToCart.php?id=<?php echo $product['product_id'];?>" class="add-cart btn fw-bold">+Keranjang</a>
                                            <a href="detailsProduct.php?id=<?php echo $product['product_id']?>" class="details btn fw-bold">Detail</a>
                                        </div>
                                    </div>
                                </div>
                        <?php  } ?>
                    </div>
                <?php  } 
                else { ?>
                    <div class="row row-cols-6">
                        <?php while($product = mysqli_fetch_array($allProduct)){  ?>
                            <div class="col">
                                <div class="card">
                                    <img src="images/<?php echo $product["foto_product"]; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $product["nama_product"];   ?></h6>
                                        <p class="card-text fw-bold"><?php echo 'Rp.'.$product["harga_product"];   ?><small class="fw-normal"> / kg</small></p>               
                                        <a href="addToCart.php?id=<?php echo $product['product_id'];?>" class="add-cart btn fw-bold">+Keranjang</a>
                                        <a href="detailsProduct.php?id=<?php echo $product['product_id']?>" class="details btn fw-bold">Detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    } ?>
             <!--END  All Product Tangkapan  -->
      </div>
    </div>
    
    <!-- <div class="card-product-olahan">
      <div class="container" style="margin-top: 4%;">
        <h5 class="fw-bold"> Produk Olahan <small><a class="fw-normal ms-2" href=""> Lihat Semua</a></small></h5>
        <div class="row row-cols-6">
          <div class="col">
            <div class="card">
              <img src="styles/img/Product/olahan.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h6 class="card-title">Product</h6>
                <p class="card-text fw-bold">Rp xxx.xxx<small class="fw-normal"> / weight</small></p>               
                <a href="#" class="btn fw-bold">+Keranjang</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  
    <div class="product-other">
      <div class="container">
        <img src="styles/img/List_Lainnya.png" alt="">
      </div>      
    </div>

    <div class="about-us">
      <div class="container">
        <hr style="margin-top: 8%; margin-bottom: 8%;">
        <h6 class="fw-bold">Belanja Mudah Dimanapun dan Kapanpun dengan HasilLaut</h6>
        <p>
          Melalui Platform Website dan Aplikasi Mobile kami memberikan kemudahan kepada para pengguna yang hendak berbelanja kebutuhan terkait dengan hasil laut.
          Belanja berbagai hasil laut lokal seperti ikan, kepiting, cumi, udang yang tentunya tersedia dalam bentuk makanan beku.
        </p>
        <br>
        <h6 class="fw-bold">Membantu Menjaga Kesejahteraan para Nelayan dan Perekonomian Indonesia</h6>
        <p>
          Melalui HasilLaut anda tidak hanya mendukung pertumbuhan dan perkembangan industri kelautan, namun juga membantu menjaga kesejahteraan para nelayan
          dan perekonomian Indonesia. Jadikan kegiatan berbelanja anda lebih bermanfaat, karena setiap pembelian anda merupakan dukungan nyata bagi para nelayan.
        </p>
        <br>
        <h6 class="fw-bold">Mudahnya Bertransaksi di HasilLaut</h6>
        <p>
          Pembayaran dapat dilakukan dengan mudah melalui media Bank Transfer yang tentunya aman dan cepat.
        </p>
        <br>
        <h6 class="fw-bold">Kecepatan Pengiriman Barang dengan HasilLaut</h6>
        <p>
          Barang akan kami antar langsung kerumah anda tentunya dengan protokol kesehatan untuk meminimalisir penyebaran covid pada masa pandemi seperti saat ini.
        </p>
        <br>
        <h6 class="fw-bold">Kenyamanan Pelanggan Terjamin di HasiLaut</h6>
        <p>
          Dengan adanya aplikasi/website ini kami menyediakan layanan penjualan hasil laut berupa ikan, udang, kepiting, dan lainnya
          dalam keadaan beku (frozen) yang kebersihannya sudah terjamin. 
        </p>
        <hr style="margin-top: 4%; margin-bottom: 2%;">
        <div class="company">
          <div class="row">
            <div class="col-md-4">
              <img style=" max-width: 60%; height: auto;" src="styles/img/LogoCompany.png" alt="">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <img style=" max-width: 100%; height: auto;" src="styles/img/TeamPhotos.png" alt="">
            </div>
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

    <!--Bootstrap JavaScript Offline-->
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
    <!--Bootstrap JavaScript Online-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
   </body> 
 </html>  

