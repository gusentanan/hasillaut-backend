<?php

require_once('./loader.php');

use databases\DatabaseControl;

use lib\users\UserData;
use lib\products\Product;
use lib\wishlist\wishList;

$db = new DatabaseControl();


$userData = new UserData($db);

$products = new Product($db);

$wish = new wishList($db);


$users = $userData->getUserById($_SESSION['user_session']);
$userID = $users['user_id'];


$product = $products->getSingleProduct();
$productID = $product['product_id'];

$res = $wish->addtoWishList($userID, $productID);

if($res){
    header("location: userWishlist.php");
}

?>