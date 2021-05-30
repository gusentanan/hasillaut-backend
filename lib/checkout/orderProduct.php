<?php

    namespace lib\checkout;

    use databases\DatabaseControl;
    use lib\checkout\orderBase;

    class orderProduct{
        private $db;
        private $order;

        function __construct(DatabaseControl $db)
        {
            $this->db = $db;
        }

        public function orders(orderBase $orders){

            $conn = $this->db->getConnection();
            $this->order = $orders;

            try{
                $cartID = $this->order->getCartID();
                $productOrder = $this->order->getProductOrder();
                $orderAddress = $this->order->getAlamatOrder();
                $orderDate = $this->order->getOrderDate();
                $totalOrder = $this->order->getTotalOrder();
                $totalQuan = $this->order->getTotalQuantity();
                $order_via = $this->order->getOrderVia();

                $stmt = $conn->prepare("INSERT INTO orders (cart_id, product_order, order_date, alamat_order, total_order, total_quantity, order_via) VALUES(?,?,?,?,?,?,?)");
                $stmt->bind_param("isssdis", $cartID, $productOrder, $orderDate, $orderAddress, $totalOrder, $totalQuan, $order_via);
                $stmt->execute();

                $delCart = $conn->prepare("DELETE FROM cartlist WHERE cart_id = ?");
                $delCart->bind_param("i", $cartID);
                $delCart->execute();

                return true;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }

        }

        public function getOrders(){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT * FROM orders");
                $stmt->execute();
                $res = $stmt->get_result();

                return $res;


            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getOrdersByID($cartID){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT * FROM orders WHERE cart_id = ?");
                $stmt->bind_param("i", $cartID);
                $stmt->execute();
                $res = $stmt->get_result();

                return $res;


            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }





    }



?>