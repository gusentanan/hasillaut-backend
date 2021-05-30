<?php

    namespace lib\checkout;

    use lib\checkout\orderBase;
    use lib\checkout\orderProduct;

    class orderFeature{

        private $checkout;

        function __construct(orderProduct $order)
        {
            $this->checkout = $order;

        }

        public function checkoutOrder($cartID, $productOrder,  $orderAddress, $orderDate, $totalOrder, $totalQuan, $orderVia){
            $dataOrders = new orderBase($cartID, $productOrder, $orderAddress, $orderDate, $totalOrder, $totalQuan, $orderVia);
            
            $res = $this->checkout->orders($dataOrders);
            return $res;
        }
    }

?>