<?php
    
    namespace lib\users;

    use lib\users\UserInterfaces\InUserUpdate;

    class UserUpdateBase implements InUserUpdate{
        private $alamat;
        private $kota;
        private $provinsi;
        private $kodepos;
        private $first_name;
        private $last_name;
        private $email;
        private $foto;
        private $noHP;


        function __construct($foto ,$first_name, $last_name, $email, $no_hp, $alamat, $kota, $provinsi, $kodepos)
        {
            $this->foto = $foto;
            $this->noHP = $no_hp;
            $this->alamat = $alamat;
            $this->kota = $kota;
            $this->provinsi = $provinsi;
            $this->kodepos = $kodepos;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
        }


        public function getAlamat(){
            return $this->alamat;
        }
        public function setAlamat(string $alamat){
            $this->alamat = $alamat;
        }
        public function getKota(){
            return $this->kota;
        }
        public function setKota(string $kota){
            $this->kota = $kota;
        }
        public function getProvinsi(){
            return $this->provinsi;
        }
        public function setProvinsi(string $provinsi){
            $this->provinsi = $provinsi;
        }
        public function getKodepos(){
            return $this->kodepos;
        }
        public function setKodepos(string $kodepos){
            $this->kodepos = $kodepos;
        }
        public function getNoHP()
        {
            return $this->noHP;
        }
        public function getFoto()
        {
            return $this->foto;
        }
        public function getFirstName(){
            return $this->first_name;
        }
        public function getLastName(){
            return $this->last_name;
        }
        public function getEmail(){
            return $this->email;
        }

    }


?>