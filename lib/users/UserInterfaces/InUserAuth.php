<?php

    namespace lib\users\UserInterfaces;

    interface InUserAuth{
        public function register(string $username, string $email, string $password, string $first_name, string $last_name);
        public function login(string $username, string $password);
        public function isLoggedIn();
        public function getUserData();
        public function logout();
    }

?>