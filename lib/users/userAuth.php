<?php

    namespace lib\users;

    use lib\users\UserInterfaces\InUserAuth;
    use lib\users\UserCredentials;
    use lib\users\UserData;
    
    class UserAuth implements InUserAuth{

        private $userInsert;
        private $err;
       // private $baseCreden;

        function __construct(UserData $UserInsert) //UserCredentials $BaseCreden)
        {
             $this->userInsert = $UserInsert;
             //$this->baseCreden = $BaseCreden;  
        }
        
        public function register(string $username, string $email, string $password, string $first_name, string $last_name)
        {
            $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
            $user = new UserRegister($email, $hashed_pwd, $username, $first_name, $last_name);
            $result = $this->userInsert->InsertData($user);

            return $result;
        }

        public function login(string $username, string $password)
        {
            $verify_user = $this->userInsert->getUserUsername($username);

            if($verify_user != false){

                if(password_verify($password, $verify_user['password'])){
                    $_SESSION['user_session'] = $verify_user['user_id'];
                    return true;
                }
                else{
                    $this->err = 'Password anda salah!';
                    return false;
                }
            }
            else{
                $this->err = "Pengguna dengan username tidak ditemukan";
                return false;
            }
        }

        public function logout()
        {
            session_destroy();
            unset($_SESSION['user_session']);

            return true;
        }

        public function isLoggedIn()
        {
            if(isset($_SESSION['user_session'])){
                return true;
            }
        }

        public function getUserData()
        {
            if(!$this->isLoggedIn()){
                return false;
            }
            $user = $_SESSION['user_session'];
            $res = $this->userInsert->getUserId($user);
            if($user == $res['user_id']){
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