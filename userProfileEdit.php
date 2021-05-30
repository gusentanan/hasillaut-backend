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

      if(isset($_POST['update'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $no_hp = $_POST['no_hp'];
            $alamat = $_POST['alamat'];
            $kota = $_POST['kota'];
            $provinsi = $_POST['provinsi'];
            $kodepos = $_POST['kodepos'];

            $file_foto = $_FILES['foto']['name'];
            $file_dir = $_FILES['foto']['tmp_name'];
            $file_size = $_FILES['foto']['size'];


            if(empty($no_hp)||empty($alamat)||empty($kota)||empty($provinsi)||empty($kodepos)||empty($file_foto)){
                $error = "Silahkan isi Form yang Kosong!";
            }
            else{
                $res = $user->imageValidation($file_foto, $file_dir, $file_size);
                if($res){
                        
                    $update = $user->updateProfile($res, $first_name, $last_name, $email, $no_hp ,$alamat, $kota, $provinsi, $kodepos);
                    if($update){
                        header("location: homePage.php");
                    }
                    else{
                        $error = "Update Gagal";
                    }
                }
                else{
                $error = $user->getLastError();
                    
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
                <a role="button" href="ProfilUser.html" style="border-color: #4ADEDE; background-color: #4ADEDE; color: white;  text-align: left; " class="btn"> <i style="width: 7%; height: 50%; margin-top: 2%; margin-left: 1%;" class="fas fa-user-circle fa-lg"></i> Akun Saya</a>
                <a role="button" href="Pesanan.html" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left;" class="btn"><i style="width: 10%; height: 50%;" class="fas fa-box-open fa-lg"></i>Pesanan</a>
                <a role="button" href="Favorit.html" style="border-color: #4ADEDE; background-color: white; color: #4ADEDE; margin-top: 4%;   text-align: left; " class="btn"><i style="width: 10%; height: 50%;" class="far fa-heart fa-lg"></i>Favorit</a>
                </div>
              </div>
              <div class="col-md-8">
                  <div class="countainer">
                  <?php if (isset($error)) : ?>
                     <div class="error">
                        <a href="#" class="btn btn-danger btn-sm del_product"> <?php echo $error?></a>                              
                     </div>
                 <?php endif; ?>
                      <h4>Edit Profile</h4>
                      <form style="margin-left: 5%; margin-right: 5%;" id="update" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                          
                          <div>
                           
                            <label>Nama Awal</label>
                            <input type="text" class="form-control" name="first_name"  placeholder="" value="<?php echo $users['first_name'];?>">
                          </div>
                          <div>
                            <label>Nama Akhir</label>
                            <input type="text" class="form-control" name="last_name"  placeholder="" value="<?php echo $users['last_name']?>" required>
                           </div>
                            <div>
                              <label>Email</label>
                              <input type="text" class="form-control"  name="email" placeholder="" value="<?php echo $users['email']; ?>" required/>
                            </div>
                            <div>
                              <label>No Telepon</label>
                               <input type="text" class="form-control"  name="no_hp" placeholder="" value="<?php echo $users['no_hp']; ?>" required/>
                            </div> 
                            <div>
                              <label>Alamat</label>
                               <input type="text" class="form-control"  name="alamat" placeholder="" value="<?php echo $users['alamat']; ?>" required/>
                            </div>
                            <div>
                              <label>Kota Tinggal</label>
                               <input type="text" class="form-control" name="kota" placeholder="" value="<?php echo $users['kota']; ?>" required/>
                            </div>
                            <div>
                              <label>Provinsi</label>
                               <input type="text" class="form-control" name="provinsi" placeholder="" value="<?php echo $users['provinsi']; ?>" required/>
                            </div>
                            <div>
                              <label>Kodepos</label>
                               <input type="text" class="form-control" name="kodepos" placeholder="" value="<?php echo $users['kodepos']; ?>" required/>
                            </div>
                            <div class="mb-3">
                              <label for="formFile" class="form-label">Foto Profile</label>
                               <td><input class="input-group" type="file" name="foto" accept="image/*" value="<?php echo $users['foto']; ?>" /></td>
                            </div>
                            <button type="submit" name="update" style="border-color:#4ADEDE; background-color: #4ADEDE; color: white; margin-top: 3%;" class="btn">Update Profile</button>
                            <a type="submit" style="border-color: #4ADEDE; background-color:white ; color: #4ADEDE; margin-left: 3%; margin-top: 3%;" class="btn" href="userProfile.php">Kembali</a>

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