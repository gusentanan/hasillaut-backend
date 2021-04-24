<?php

    namespace lib\admin;

    use lib\admin\AdminInterfaces\InAdminAuth;
    use lib\admin\AdminData;

    class AdminAuth implements InAdminAuth{
        private $adminInsert;
        private $err;

        function __construct(AdminData $adminInsert)
        {
            $this->adminInsert = $adminInsert;
        }

        public function login(string $username, string $password)
        {
            $verify_admin = $this->adminInsert->getAdminUsername($username);

            if($verify_admin != false){

                if(password_verify($password, $verify_admin['password_admin'])){
                    $_SESSION['user_session'] = $verify_admin['admin_id'];
                    return true;
                }
                else{
                    $this->err = "Password Admin Anda Salah!";
                    return false;
                }
            }
            else{
                $this->err = "Pengguna Username tidak ditemukan!";
                return false;
            }

        }

        public function isLoggedIn()
        {
            if(isset($_SESSION['user_session'])){
                return true;
            }
        }

        public function getAdminData(){
            if(!$this->isLoggedIn()){
                return false;
            }
            $admin = $_SESSION['user_session'];
            $res = $this->adminInsert->getAdminId($admin);
            if($admin == $res['admin_id']){
                return $res;
            }
            else{
                return false;
            }

        }

        public function getLastError(){
         
            return $this->err;
         }

      
    }

?>