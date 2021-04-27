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
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $update = $user->updateProfile($alamat, $kota, $provinsi, $kodepos, $email, $username,$password,$first_name, $last_name);
       
        if($update){
            header("location: userProfile.php");
        }
        else{
            echo "Update Gagal";
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
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQF2psCzfbB611rnUhxgMi-lc2oB78ykqDGYb4v83xQ1pAbhPiB&usqp=CAU"><span class="font-weight-bold">Amelly</span><span class="text-black-50">amelly12@bbb.com</span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <form class="update-form" method="post">
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Nama Depan</label><input type="text" class="form-control" placeholder="<?php echo $users['first_name']?>" name="first_name"></div>
                                <div class="col-md-6"><label class="labels">Nama Belakang</label><input type="text" class="form-control" value="" placeholder="<?php echo $users['last_name']?>" name="last_name"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Nomor Telepon</label><input type="text" class="form-control" placeholder="<?php echo $users['no_hp']?>" name="no_hp"></div>
                                <div class="col-md-12"><label class="labels">Alamat</label><input type="text" class="form-control" placeholder="<?php echo $users['alamat']?>" name="alamat"></div>
                                <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="<?php echo $users['email']?>" name="email"></div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Kota Tinggal</label><input type="text" class="form-control" placeholder="<?php echo $users['kota']?>" name="kota"></div>
                                <div class="col-md-6"><label class="labels">Provinsi</label><input type="text" class="form-control" placeholder="<?php echo $users['provinsi']?>" name="provinsi"></div>
                                <div class="col-md-6"><label class="labels">Kodepos</label><input type="text" class="form-control" placeholder="<?php echo $users['kodepos']?>" name="kodepos"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Username</label><input type="text" class="form-control" placeholder="<?php echo $users['username']?>" name="username"></div>
                                <div class="col-md-6"><label class="labels">Password</label><input type="text" class="form-control" placeholder="password anda" name="password"></div>
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