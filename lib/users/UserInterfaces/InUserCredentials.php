<?php

    namespace lib\users\UserInterfaces;

    interface InUserCredentials{
        public function getEmail();
        public function setEmail(string $email);
        public function getPassword();
        public function setPassword(string $password);
        public function getUsername();
        public function setUsername(string $username);
        public function get_firstName();
        public function set_firstName(string $first_name);
        public function get_lastName();
        public function set_lastName(string $last_name);
    }

?>