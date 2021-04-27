<?php
    
    namespace lib\users;

    use lib\users\UserInterfaces\InUserUpdate;

    class UserUpdate implements InUserUpdate{
        private $alamat;
        private $kota;
        private $provinsi;
        private $kodepos;

        function __construct($foto ,$no_hp, $alamat, $kota, $provinsi, $kodepos)
        {
            $this->foto = $foto;
            $this->noHP = $no_hp;
            $this->alamat = $alamat;
            $this->kota = $kota;
            $this->provinsi = $provinsi;
            $this->kodepos = $kodepos;
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

    }


?>