<?php

    namespace lib\admin\AdminInterfaces;

    interface InAdminData{
        public function getAdminId(int $id);
        public function getAdminUsername(string $username);
       
    }


?>