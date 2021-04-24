<?php

    namespace lib\users;

    use lib\users\UserInterfaces\InUserCredentials;

    class UserCredentials implements InUserCredentials{

        private $email;
        private $password;
        private $username;
        private $first_name;
        private $last_name;

        function __construct($email, $password, $username, $first_name, $last_name){
            $this->email = $email;
            $this->password = $password;
            $this->username = $username;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setUsername(string $username){
            $this->username = $username;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail(string $email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword(string $password){
            $this->password = $password;
        }

        public function get_firstName(){
            return $this->first_name;
        }

        public function set_firstName(string $first_name){
            $this->first_name = $first_name;
        }

        public function get_lastName(){
            return $this->last_name;
        }

        public function set_lastName(string $last_name){
            $this->last_name = $last_name;
        }

    }

?>