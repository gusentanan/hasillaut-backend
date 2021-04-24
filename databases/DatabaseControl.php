<?php

    namespace databases;

    use databases\DatabaseInterfaces\DatabaseInterface;

    class DatabaseControl implements DatabaseInterface{
     
        // Properti untuk koneksi database
        protected $host = 'localhost';
        protected $user = 'root';
        protected $password = '';
        protected $database = 'hasillaut';

        public $connect = null;

        public function __construct(){
            $this->connect = new \mysqli($this->host, $this->user, $this->password, $this->database);
            if($this->connect->connect_error){
                echo 'Error : '.$this->connect->connect_error;
            }
        }

        public function __destruct(){
            $this->closeConnect();
        }
        
        // Menutup koneksi mysqli
        protected function closeConnect(){
            if($this->connect != null){
                $this->connect->close();
                $this->connect = null;
            }
        }

        public function getConnection(){
            return $this->connect;
        }

    }

    


?>