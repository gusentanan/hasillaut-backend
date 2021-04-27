<?php

    namespace lib\users\UserInterfaces;

    interface InUserUpdate{
        public function getAlamat();
        public function setAlamat(string $alamat);
        public function getKota();
        public function setKota(string $kota);
        public function getProvinsi();
        public function setProvinsi(string $provinsi);
        public function getKodepos();
        public function setKodepos(string $kodepos);
        public function getNoHP();
    }

?>