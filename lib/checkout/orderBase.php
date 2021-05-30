<?php

    namespace lib\checkout;

    class orderBase{

        private $cart_id;
        private $product_order;
        private $alamat_order;
        private $order_date;
        private $total_order;
        private $total_quantity;
        private $order_via;

        function  __construct($cart_id, $product_order, $alamat_order, $order_date, $total_order, $total_quantity, $order_via){
            
            $this->cart_id = $cart_id;
            $this->product_order = $product_order;
            $this->alamat_order = $alamat_order;
            $this->order_date = $order_date;
            $this->total_order = $total_order;
            $this->total_quantity = $total_quantity;
            $this->order_via = $order_via;
        }

        public function getCartID(){
            return $this->cart_id;

        }

        public function getProductOrder(){
            return $this->product_order;

        }

        public function getAlamatOrder(){
            return $this->alamat_order;

        }

        public function getOrderDate(){
            return $this->order_date;

        }

        public function getTotalOrder(){
            return $this->total_order;

        }

        public function getTotalQuantity(){
            return $this->total_quantity;

        }

        public function getOrderVia(){
            return $this->order_via;
            
        }


    }


?>