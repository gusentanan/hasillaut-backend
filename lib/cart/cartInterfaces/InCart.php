<?php

    namespace lib\cart\cartInterfaces;

    interface InCart{
        public function addItem($cartID, $productID, $unitPrice, $quantity);
        public function deleteItem($cartID, $productID);
        public function increaseQuantity();

    }

?>