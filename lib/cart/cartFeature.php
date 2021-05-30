<?php

    namespace lib\cart;

    use lib\cart\Cart;

    class cartFeature{

        private $cartData;

        function __construct(Cart $cart)
        {
            $this->cartData = $cart;
        }

        public function addToCart($cartID, $productID, $unitPrice){
            $quantity = 1;

            $res = $this->cartData->addItem($cartID, $productID, $unitPrice, $quantity);
            return $res;
            
        }

    }

?>