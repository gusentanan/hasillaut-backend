<?php

    namespace lib\products\productInterfaces;

    use lib\products\productInterfaces\InproductCredentials;
    use lib\products\ProductBase;

    interface InProduct{
        public function addProduct(ProductBase $product);
        public function updateProduct(ProductBase $product);
        public function deleteProduct();

    }


?>