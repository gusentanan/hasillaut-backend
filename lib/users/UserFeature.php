<?php

namespace lib\users;

use lib\users\UserData;
use lib\users\UserRegister;
use lib\users\UserUpdate;

class UserFeature{
        private $db;
        private $err;
        private $userData;
        
        function __construct(UserData $user)
        {
            $this->userData = $user;
        }

        public function updateProfile($foto ,$no_hp, $alamat, $kota, $provinsi, $kodepos){
            $userCreden = new UserUpdate($foto ,$no_hp, $alamat, $kota, $provinsi, $kodepos);
    
            $res = $this->userData->UpdateDataProfile($userCreden);
            return $res;
        }


    }
?>