<?php

    namespace lib\users;

    use databases\DatabaseControl;
    use lib\users\UserInterfaces\InUserData;
    use lib\admin\AdminData;
    use lib\users\UserUpdateBase;

    class UserData implements InUserData{
        private $db;
        private $err;
        private $userBaseData;
        private $userData;
        private $admins;
        
        function __construct(DatabaseControl $database)
        {
            $this->db = $database;
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }

        public function InsertData(UserRegisterBase $userBaseData)
        {
            $this->userBaseData = $userBaseData;
            $this->admins = new AdminData($this->db);
            
            try{
                $conn = $this->db->getConnection();

                $username = $this->userBaseData->getUsername();
                $email = $this->userBaseData->getEmail();
                $password = $this->userBaseData->getPassword();
                $first_name = $this->userBaseData->get_firstName();
                $last_name = $this->userBaseData->get_lastName();

                $userValidation = $this->getUserByUsername($username);
                $adminValidation = $this->admins->getAdminUsername($username);

                if($username != $userValidation['username'] && $username != $adminValidation['username_admin']){
                    $stmt = $conn->prepare("INSERT INTO users (username, email, password, first_name, last_name) VALUES(?,?,?,?,?)");
                    $stmt->bind_param("sssss", $username, $email, $password, $first_name, $last_name);
                    $stmt->execute();

                    return true;
                }
                else{
                    $this->err = "Username tersebut tidak tersedia!";
                    return false;
                }

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }
        
 
        public function UpdateDataProfile(UserUpdateBase $userData)
        {
            $this->userData = $userData;
            try{
                $currentUser = $_SESSION['user_session'];
                $conn = $this->db->getConnection();

                $foto = $this->userData->getFoto();
                $no_hp = $this->userData->getNoHP();
                $alamat = $this->userData->getAlamat();
                $kota = $this->userData->getKota();
                $provinsi = $this->userData->getProvinsi();
                $kodepos = $this->userData->getKodepos();
                $first_name = $this->userData->getFirstName();
                $last_name = $this->userData->getLastName();
                $email = $this->userData->getEmail();


                $stmt = $conn->prepare("UPDATE users SET foto=?, no_hp=?, alamat=?, kota=?, provinsi=?, kodepos=?, first_name=?, last_name=?, email=? WHERE user_id=?");
                $stmt->bind_param("sssssssssi", $foto, $no_hp, $alamat, $kota, $provinsi, $kodepos, $first_name, $last_name, $email, $currentUser);
                $stmt->execute();

                return true;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserById(int $id)
        {
            try{
                $conn = $this->db->getConnection();
                $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
                $stmt->bind_param("i", $id);

                $res = $stmt->execute();
                $res = $stmt->get_result();

                if($res->num_rows > 0){
                    return $res->fetch_assoc();
                }
                else{
                    $this->err = "Pengguna dengan Id tidak ditemukan!";
                    return false;
                }
            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserByUsername(string $username)
        {
            try{
                $conn = $this->db->getConnection();
                $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
                $stmt->bind_param("s", $username);

                $res = $stmt->execute();
                $res = $stmt->get_result();

                if($res->num_rows > 0){
                    return $res->fetch_assoc();
                  
                }
                else{
                   
                    return false;
                }
            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getLastError(){
            return $this->err;
        }
    }



?>