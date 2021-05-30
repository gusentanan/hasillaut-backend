<?php
    require_once('./loader.php');

    use databases\DatabaseControl;
    use lib\admin\AdminAuth;
    use lib\admin\AdminFeature;
    use lib\admin\AdminData;
    use lib\products\Product;
    use lib\products\ProductBase;
    use lib\users\UserData;

    $db = new DatabaseControl();  
    
    $product =  new Product($db);

    $user = new UserData($db);

    $admin = new AdminData($db);

    $adminFeature = new AdminFeature($product, $user);

   // $adminFeature->AddProduct();
    $adminID = $_SESSION['user_session'];
    $getDataAdmin = $admin->getAdminId($adminID);
    $getKategori = $product->getKategori();
    $getProduct = $product->getSingleProduct();

    if(isset($_POST['update'])){
      
      $namaProduk = $_POST['nama_produk'];
      $kodeProduk = $_POST['kode_produk'];
      $kategoriProduk = $_POST['kategori_produk'];
      $deskripsiProduk = $_POST['deskripsi_produk'];
      $hargaProduk = $_POST['harga_produk'];

      $file_foto = $_FILES['foto_produk']['name'];
      $file_dir = $_FILES['foto_produk']['tmp_name'];
      $file_size = $_FILES['foto_produk']['size'];

    if(empty($namaProduk)||empty($kodeProduk)||empty($kategoriProduk)||empty($deskripsiProduk)||empty($hargaProduk)||empty($file_foto)){
        $error = "Silahkan isi Form yang Kosong!";
    }
    else{

            $fotoProduk = $adminFeature->imageValidation($file_foto, $file_dir, $file_size);
            
            if($fotoProduk){
                $adminFeature->UpdateProduct($fotoProduk, $namaProduk, $hargaProduk, $deskripsiProduk, $kategoriProduk, $kodeProduk);
                if($adminFeature){
                    header("location: manageProduct.php");
                }
                else{
                    $error = "Update Gagal";
                }
            }
            else{
                $error = $adminFeature->getLastError();
            }
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
    <script src="https://kit.fontawesome.com/4ecb43dae8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/produkadmin.css">
    
    <title>HasilLaut</title>
    <link rel="icon" href="styles/img/Navbar/Logo.png" type="image/icon type">
  </head>
  <body>
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
      <div style="margin-left: 5%;" class="product-info">
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div style="width: 80%;" class="btn-group-vertical">
                <a role="button" href="adminPage.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE;  text-align: left; " class="btn"> <i style="width: 7%; height: 50%; margin-top: 2%; margin-left: 1%;" class="fas fa-user-circle fa-lg"></i> Akun Saya</a>
                  <a role="button" href="manageProduct.php" style="border-color: #4ADEDE; background-color: #4ADEDE; color: white; margin-top: 4%;   text-align: left;" class="btn"><i style="width: 10%; height: 50%;" class="fas fa-box-open fa-lg"></i>Kelola Produk</a>
                  <a role="button" href="addProduct.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left;" class="btn"><i style="width: 10%; height: 50%;" class="far fa-plus-square"></i>Tambah Produk</a>
                  <a role="button" href="adminNotif.php" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left; " class="btn"><i style="width: 10%; height: 50%;" class="far fa-heart fa-lg"></i>Notifikasi</a>
                </div>
            </div>
              <div class="col-md-8">
                  <div class="countainer">
                  <?php if (isset($error)) : ?>
                     <div class="error">
                        <a href="#" class="btn btn-danger btn-sm del_product"> <?php echo $error?></a>                              
                     </div>
                 <?php endif; ?>
                      <h4>Edit Produk</h4>
                      <form style="margin-left: 5%; margin-right: 5%;" id="update_form" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                          <!-- <div>
              
                            <label>Tanggal</label>
                             <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
                          </div> -->
                          <!-- <div>
                           <input type="hidden" name="product_id" id="product_id" value=""/>
                            <label>Product ID</label>
                            <input type="text" class="form-control" name="product_id" id="product_id" value="<?php echo $getProduct['product_id']; ?>" readonly/>
                          </div> -->
                          <div>
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="product_name" placeholder="Enter Product Name" value="<?php echo $getProduct['nama_product']; ?>" required>
                           </div>
                            <div>
                              <label>Kode Produk</label>
                              <select class="form-control" id="select_cat" name="kode_produk" required/>
                              <?php
                                  $kode = $getDataAdmin['admin_id'];
                                  echo "<option value='$kode'>$kode</option>";
                              ?>    
                              </select>
                            </div>
                            <div>
                              <label>Kategori Produk</label>
                              <select class="form-control" id="select_cat" name="kategori_produk" required/>
                              <?php
                                  while($data = mysqli_fetch_array($getKategori)){
                                    ?>
                                    <option value='<?php echo $data['kategori_id']?>'><?php echo $data['nama_kategori']?></option>
                                  <?php
                                  }
                              ?>
                          
                              </select>
                            </div>
                            <div>
                              <label>Harga Produk</label>
                              <input type="text" class="form-control" id="product_price" name="harga_produk" placeholder="Masukkan Harga Produk" value="<?php echo $getProduct['harga_product']; ?>" required/>
                            </div>
                             <div>
                              <label>Deskripsi Produk</label>
                               <textarea type="text" class="form-control" id="product_qty" name="deskripsi_produk" placeholder="Deskripsi Produk" value="<?php echo $getProduct['desc_product']; ?>" required><?php echo $getProduct['desc_product']; ?></textarea> 
                            </div>
                            <div class="mb-3">
                              <label for="formFile" class="form-label">Produk Foto</label>
                               <td><input class="input-group" type="file" name="foto_produk" accept="image/*" value="<?php echo $getProduct['foto_product']; ?>" /></td>
                            </div>
                            <button type="submit" name="update" style="border-color:#4ADEDE; background-color: #4ADEDE; color: white; margin-top: 3%;" class="btn">Update Produk</button>

                        </div>
                      </form>     
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