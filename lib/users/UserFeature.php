<?php

namespace lib\users;

use lib\users\UserData;
use lib\users\UserUpdateBase;
use lib\products\Product;


class UserFeature{
    
        private $err;
        private $userData;
        
        function __construct(UserData $user)
        {
            $this->userData = $user;
        }

        public function updateProfile($foto , $first_name, $last_name, $email, $no_hp, $alamat, $kota, $provinsi, $kodepos){
            $userCreden = new UserUpdateBase($foto, $first_name, $last_name, $email, $no_hp, $alamat, $kota, $provinsi, $kodepos);
    
            $res = $this->userData->UpdateDataProfile($userCreden);
            return $res;
        }


        public function imageValidation($fileFoto, $fileDir, $fileSize){
            if(empty($fileFoto)){
                return $this->err = "Masukkan File Foto Anda";
            }
            else{
                $upload_dir = 'images/';
                $extension = strtolower(pathinfo($fileFoto, PATHINFO_EXTENSION));
                $valid_extension = array('jpeg', 'jpg', 'png', 'gif');

                $ProfileFoto = rand(1000, 10000).".".$extension;

                if(in_array($extension, $valid_extension)){
                    if($fileSize < 5000000){
                        move_uploaded_file($fileDir, $upload_dir.$ProfileFoto);
                        return $ProfileFoto;
                    }
                    else{
                        $this->err = "Ukuran foto lebih dari 5 MB";
                        return false;
                    }
                }
                else{
                     $this->err = "Maaf Ekstensi gambar tidak sesuai (JPG, JPEG, PNG, GIF)"; 
                     return false;
                }

            }
        }



        public function getLastError(){
            return $this->err;
        }


    }
?>