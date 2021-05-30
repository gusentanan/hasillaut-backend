<?php

    namespace lib\admin;

    use databases\DatabaseControl;
    use lib\admin\AdminInterfaces\InAdminData;

    class AdminData implements InAdminData{

        private $database;
        private $err;

        function __construct(DatabaseControl $db)
        {
            $this->database = $db;
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }

        public function getAdminId(int $id)
        {
            try{
                $conn = $this->database->getConnection();
                $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=?");
                $stmt->bind_param("i", $id);
                
                $res = $stmt->execute();
                $res = $stmt->get_result();

                if($res->num_rows > 0){
                    return $res->fetch_assoc();
                }
                else{
                    $this->err = "Admin tidak ditemukan!";
                    return false;
                }
            }
            catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }


        }

        public function getAdminUsername(string $username){
            try{
                $conn = $this->database->getConnection();
                $stmt = $conn->prepare("SELECT * FROM admin WHERE username_admin=?");
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