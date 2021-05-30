<?php

    namespace lib\users\UserInterfaces;
    
    use lib\users\UserRegisterBase;
    use lib\users\UserUpdateBase;

interface InUserData{
        public function InsertData(UserRegisterBase $userData);
        public function UpdateDataProfile(UserUpdateBase $userData);
        public function getUserById(int $id);
        public function getUserByUsername(string $username);
    }

?>