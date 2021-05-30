<?php

    namespace lib\admin;

    use lib\products\Product;
    use lib\products\ProductBase;
    use lib\admin\AdminData;
    use lib\admin\AdminAuth;
    use lib\users\UserData;
    use lib\users\UserFeature;

class AdminFeature extends UserFeature{
        
        private $adminData;
        private $user;
        private $product;

        function __construct(Product $product, UserData $user)
        {
            $this->product = $product;
            $this->user = $user;
        }

        public function AddProduct($fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct){
            $getData = new ProductBase($fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct);

            $res = $this->product->addProduct($getData);
            return $res;
        }

        public function UpdateProduct($fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct){
            $getData = new ProductBase($fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct);

            $res = $this->product->updateProduct($getData);
            return $res;
        }


        
    }

?>