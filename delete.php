<?php  

  require_once('./loader.php');

  use databases\DatabaseControl;
  use lib\admin\AdminAuth;
  use lib\users\UserAuth;
  use lib\users\UserData;
  use lib\admin\AdminData;
  use lib\products\Product;

  $db = new DatabaseControl();

  $userData = new UserData($db);
  $adminData = new AdminData($db);
  $productData = new Product($db);
  
  $user = new UserAuth($userData);
  $admin = new AdminAuth($adminData);
  
  //$adminProduct =  $productData->getProductByIdAdmin($_SESSION['user_session']);
  $res = $productData->deleteProduct();
  if($res){
    header("location: manageProduct.php");
  }
 
?> 
