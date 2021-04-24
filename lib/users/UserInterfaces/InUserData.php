<?php

    namespace lib\users\UserInterfaces;
    
    use lib\users\UserCredentials;

    interface InUserData{
        public function InsertData(UserCredentials $userData);
        public function getUserId(int $id);
        public function getUserUsername(string $username);
    }

?>