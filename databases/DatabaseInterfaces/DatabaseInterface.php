<?php

    namespace databases\DatabaseInterfaces;

    interface DatabaseInterface{
        public function __construct();
        public function __destruct();
        public function getConnection(); 
    }

?>