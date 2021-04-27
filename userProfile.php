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

      $users = $userData->getUserId($_SESSION['user_session']);

      if(isset($_POST['update'])){
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        $provinsi = $_POST['provinsi'];
        $kodepos = $_POST['kodepos'];

        $file_foto = $_FILES['foto']['name'];
        $file_dir = $_FILES['foto']['tmp_name'];
        $file_size = $_FILES['foto']['size'];

        if(empty($file_foto)){
            $error = "Masukkan File Foto Anda";
        }
        else{
            $upload_dir = 'images/';
            $ext = strtolower(pathinfo($file_foto, PATHINFO_EXTENSION));
            $valid_extension = array('jpeg', 'jpg', 'png', 'gif');

            $profile_foto = rand(1000,1000000).".".$ext;

            if(in_array($ext, $valid_extension)){
                if($file_size < 5000000){
                    move_uploaded_file($file_dir, $upload_dir.$profile_foto);
                }
                else{
                    $error = "Ukuran foto lebih dari 5 MB";
                }
            }else{
                $error = "Maaf, Ekstensi gambar tidak sesuai (JPG, JPEG, PNG & GIF)";
            }

            if(!isset($error)){
                
                 $update = $user->updateProfile($profile_foto ,$no_hp ,$alamat, $kota, $provinsi, $kodepos);
                 if($update){
                    echo "halo";
                    header("location: userProfile.php");
                }
                else{
                    echo "Update Gagal";
                }
            }
        }
       
      }


?>

<html>  
   <head> 
     <meta charset="utf-8"> 
     <title>Register</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
     <link rel="stylesheet" href="styles/style2.css" media="screen" title="no title" charset="utf-8"> 
   </head> 
   <body> 
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="images/<?php echo $users['foto']?>"><span class="font-weight-bold"><?php echo $users['username'] ?></span><span class="text-black-50"><?php echo $users['email']?></span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <form class="update-form" method="post" enctype="multipart/form-data">
                        <?php if (isset($error)) : ?>
                            <div class="error">
                                <?php echo $error, $ext ?>
                                
                            </div>

                        <?php endif; ?>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Nomor Telepon</label><input type="text" class="form-control" placeholder="Nomor Telepon" name="no_hp" value="<?php echo $users['no_hp']?>"></div>
                                <div class="col-md-12"><label class="labels">Alamat</label><input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?php echo $users['alamat']?>"></div>
                                <!-- <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="<?php echo $users['email']?>" name="email"></div> -->
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Kota Tinggal</label><input type="text" class="form-control" placeholder="Kota" name="kota" value="<?php echo $users['kota']?>"></div>
                                <div class="col-md-6"><label class="labels">Provinsi</label><input type="text" class="form-control" placeholder="Provinsi" name="provinsi" value="<?php echo $users['provinsi']?>"></div>
                                <div class="col-md-6"><label class="labels">Kodepos</label><input type="text" class="form-control" placeholder="Kodepos" name="kodepos" value="<?php echo $users['kodepos']?>"></div>
                            </div>
                            <div class="row-mt-3">
                                <tr>
                                <td><label class="control-label">Foto Profile</label></td>
                                    <td><input class="input-group" type="file" name="foto" accept="image/*" /></td>
                                </tr>
                            </div>
            
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="update">Save Profile</button></div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience"><span></span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i><a href="index.php">Home</a></span></div><br>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body> 
 </html>  