<?php

    namespace lib\cart;
    
    use databases\DatabaseControl;
    use lib\products\Product;
    use lib\cart\cartInterfaces\InCart;
    

class Cart implements InCart{

    private $db;

    function __construct(DatabaseControl $db)
    {
        $this->db = $db;
    }

    public function addItem($cartID, $productID, $unitPrice, $quantity)
    {
        $conn = $this->db->getConnection();

        try{
            $stmt = $conn->prepare("INSERT INTO cartlist (cart_id, product_id, unitPrice, quantity) VALUES(?,?,?,?)");
            $stmt->bind_param("iidi", $cartID, $productID, $unitPrice, $quantity);
            $stmt->execute();

            return true;

        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }

    }

    public function deleteItem($cartID, $productID)
    {
        $conn = $this->db->getConnection();

        try{
            $stmt = $conn->prepare("DELETE FROM cartlist WHERE cart_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $cartID, $productID);
            $stmt->execute();

            return true;

        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function increaseQuantity()
    {
        
    }

    public function getAllCartItem($cartID){

        $conn = $this->db->getConnection();

        try{
            $stmt = $conn->prepare("SELECT * FROM cartlist JOIN product ON product.product_id = cartlist.product_id WHERE cart_id = ?");
            $stmt->bind_param("i", $cartID);
            $stmt->execute();
            
            $res = $stmt->get_result();

            return $res;

        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }
    
    }

    public function getCartID($userID){
        
        $conn = $this->db->getConnection();

        try{
            $stmt = $conn->prepare("SELECT cart_id FROM cart WHERE user_id = ?");
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            
            $res = $stmt->get_result();

            return $res->fetch_assoc();

        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getCartMain($cartID){
        $conn = $this->db->getConnection();

        try{
            $stmt = $conn->prepare("SELECT * FROM cart WHERE cart_id = ?");
            $stmt->bind_param("i", $cartID);
            $stmt->execute();
            
            $res = $stmt->get_result();

            return $res->fetch_assoc();

        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function updateQuantity($quantity, $pID, $cartID){
        $conn = $this->db->getConnection();

        try{
            $stmt = $conn->prepare("UPDATE cartlist SET quantity = ? WHERE product_id = ? AND cart_id =?");
            $stmt->bind_param("iii", $quantity, $pID, $cartID);
            $stmt->execute();
        

            return true;

        }catch(\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    
}

?>