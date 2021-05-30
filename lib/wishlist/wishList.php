<?php

    namespace lib\wishlist;

    use databases\DatabaseControl;
  
    class wishList{

        private $db;

        function __construct(DatabaseControl $db)
        {
            $this->db = $db;
        }

        public function addtoWishList($user_id, $product_id){
            $conn = $this->db->getConnection();

            try{    
                $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?,?)");
                $stmt->bind_param("ii", $user_id, $product_id);
                $stmt->execute();

                return true;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }


        public function viewWishList($user_id){
            $conn = $this->db->getConnection();

            try{    
                $stmt = $conn->prepare("SELECT * FROM wishlist JOIN product ON wishlist.product_id = product.product_id  WHERE user_id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $res = $stmt->get_result();

                return $res;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }



        public function delfromWishList($user_id, $product_id){
            $conn = $this->db->getConnection();

            try{    
                $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id =? AND product_id = ?");
                $stmt->bind_param("ii", $user_id, $product_id);
                $stmt->execute();

                return true;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

    }

    
?>