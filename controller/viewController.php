<?php include("../model/Cart.php"); ?>
<?php include("../inc/header.php"); ?>
<?php 
    $db = new Database("localhost", "techstore", "root", "");
    $product = null;

    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id = $_GET["id"];
        $product = $db->getProductById($id);
    }

    $randomProducts = $db->getRandomProducts();

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new Cart();
    }

    if(isset($_POST['add_to_cart'])) {
        $item_id = $_GET['id'];
        $_SESSION['cart']->addItem($item_id);
    }

?>