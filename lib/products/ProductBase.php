<?php

    namespace lib\products;

    use lib\products\productInterfaces\InproductCredentials;

    class ProductBase implements InproductCredentials{
        
        private $fotoProduct;
        private $namaProduct;
        private $hargaProduct;
        private $deskripsi;
        private $kategori;
        private $kodeProduct;

        function __construct($fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct)
        {
            $this->fotoProduct = $fotoProduct;
            $this->namaProduct = $namaProduct;
            $this->hargaProduct = $hargaProduct;
            $this->deskripsi = $deskripsi;
            $this->kategori = $kategori;
            $this->kodeProduct = $kodeProduct;

        }

        public function getFotoProduct(){
            return $this->fotoProduct;
        }
        public function getNamaProduct(){
            return $this->namaProduct;
        }
        public function getHargaProduct(){
            return $this->hargaProduct;
        }
        public function getDescProduct(){
            return $this->deskripsi;
        }
        public function getKategori(){
            return $this->kategori;
        }
        public function getKodeProduct(){
            return $this->kodeProduct;
        }
    }

?>