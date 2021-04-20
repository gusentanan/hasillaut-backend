<?php

    class Authentication{
        private $db;
        private $err;

        function __construct($connection){
            $this->db = $connection;
            session_start();
        }

        public function register($username ,$email, $password, $first_name, $last_name){
             
            try{
                $hash_pwd = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $this->db->prepare("INSERT INTO users (username, email, password, first_name, last_name) VALUES(?,?,?,?,?)");
                $stmt->bind_param("sssss", $username, $email, $hash_pwd, $first_name, $last_name);
                $stmt->execute();

                return true;
            }
            catch(Exception $e){
                
                echo $e->getMessage(); 
                return false;
            }
        }

        public function login($email, $password){
            try{
                $stmt = $this->db->prepare("SELECT * FROM admin WHERE email_admin = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $res_admin = $stmt->get_result();

                    if($res_admin->num_rows > 0){

                            $admin_data = $res_admin->fetch_assoc(); 

                            if(password_verify($password, $admin_data['password_admin'])){
                                $_SESSION['user_session'] = $admin_data['admin_id'];
                                return true;
                            }
                            else{     
                                $this->err = "Email atau password anda salah!";
                                return false;
                            }
                        
                    }
                    else {

                        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $res_user = $stmt->get_result();

                        if($res_user->num_rows > 0){
                            $user_data = $res_user->fetch_assoc();

                            if(password_verify($password, $user_data["password"])){
                                $_SESSION['user_session'] = $user_data['user_id'];
                                return true;
                            }
                            else{
                                $this->err = "Email atau password anda salah!";
                                return false;
                            }
                        }
                        else{
                            $this->err = "Email atau password anda salah!";
                            return false;
                        }
                    }
                        
                }catch(Exception $e){
                    echo $e->getMessage();
                    return false;
                }

        }

        public function isLoggedIn(){
            if(isset($_SESSION['user_session'])){
                return true;
            }
        }

        
        public function getUserData(){

            if(!$this->isLoggedIn()){
                return false;
            }

            try{
                $stmt = $this->db->prepare("SELECT * FROM admin WHERE admin_id=?");
                $stmt->bind_param("i", $_SESSION['user_session']);
                $stmt->execute();


                $res_execute = $stmt->get_result();

                if($res_execute->num_rows > 0){
                    return $res_execute->fetch_assoc();
                }
                else{
                    $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id=?");
                    $stmt->bind_param("i", $_SESSION['user_session']);
                    $stmt->execute();
                    
                    $res_execute = $stmt->get_result();
                    return $res_execute->fetch_assoc();

                }

            }catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function logout(){
            session_destroy();
            unset($_SESSION['user_session']);

            return true;
        }

        public function getLastError(){
    
            return $this->err;
        }

    }


?>