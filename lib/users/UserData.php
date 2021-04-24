<?php

    namespace lib\users;

    use databases\DatabaseControl;
    use lib\users\UserInterfaces\InUserData;
    use lib\admin\AdminData;

    class UserData implements InUserData{
        private $db;
        private $err;
        private $userData;
        private $adminData;

        function __construct(DatabaseControl $database)
        {
            $this->db = $database;
            session_start();
        }

        public function InsertData(UserCredentials $userData)
        {
            $this->userData = $userData;
            $this->adminData = new AdminData($this->db);
            
            try{
                $conn = $this->db->getConnection();

                $username = $this->userData->getUsername();
                $email = $this->userData->getEmail();
                $password = $this->userData->getPassword();
                $first_name = $this->userData->get_firstName();
                $last_name = $this->userData->get_lastName();

                $userValidation = $this->getUserUsername($username);
                $adminValidation = $this->adminData->getAdminUsername($username);

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

        public function getUserId(int $id)
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

        public function getUserUsername(string $username)
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