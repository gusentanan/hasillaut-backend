<?php

require_once('./loader.php');

use databases\DatabaseControl;
use lib\cart\Cart;
use lib\cart\cartFeature;
use lib\users\UserData;
use lib\products\Product;

$db = new DatabaseControl();

$cart = new Cart($db);

$userData = new UserData($db);

$products = new Product($db);

$cartAction = new cartFeature($cart);


$users = $userData->getUserById($_SESSION['user_session']);
$userID = $users['user_id'];
$cartID = $cart->getCartID($userID);

$product = $products->getSingleProduct();
$productID = $product['product_id'];
$productPrice = $product['harga_product'];
$res = $cartAction->addToCart($cartID['cart_id'], $productID, $productPrice);


if($res){
    header("location: homePage.php");
}

?>