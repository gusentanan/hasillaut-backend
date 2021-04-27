<?php

    namespace lib\users\UserInterfaces;
    
    use lib\users\UserCredentials;
    use lib\users\UserRegister;
    use lib\users\UserUpdate;

interface InUserData{
        public function InsertData(UserRegister $userData);
        public function UpdateDataProfile(UserUpdate $userData);
        public function getUserId(int $id);
        public function getUserUsername(string $username);
    }

?>