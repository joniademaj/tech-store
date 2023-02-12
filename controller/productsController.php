<?php include("../inc/header.php"); ?>
<?php 
    include("../model/Product.php");
    include("../model/Cart.php");

    $products = [];
    
    $products[] = $db->getProducts();
    
?>