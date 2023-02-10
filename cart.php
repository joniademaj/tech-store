<?php include("./OOP/Cart.php"); ?>
<?php include("./inc/header.php"); ?>
<?php 
    // printf("%d", isset($_SESSION["cart"]));
    // echo "Contents of the cart:<br>";

    // // $products = null;
    // foreach ($_SESSION['cart']->getItems() as $item_id) {
    //   echo "Item ID: $item_id<br>";
    //   $products = $db->getProductById($item_id);
    // }

    
?>
<div class="cart-content">
    <?php if(isset($_SESSION["cart"])): ?>
        <?php foreach($_SESSION['cart']->getItems() as $item_id): ?>
            <?php foreach($db->getProductById($item_id) as $product): ?>
                <div class="cart-item">
                    <div class="image">
                        <img src="images/<?= $product['product_img'] ?>" alt="">
                    </div>
                    <div class="product-name">
                        <h2><?php echo $product["product_name"]; ?></h2>
                    </div>
                    <div class="quantity">
                        <button class="increment">+</button>
                        <input type="text" value="1" class="qty-value">
                        <button class="decrement">-</button>
                    </div>
                    <div class="price">
                        <p>$ <?= $product["price"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="total">
        <?php $total = 0; ?>
        <?php if(isset($_SESSION["cart"])): ?>
            <?php foreach($_SESSION['cart']->getItems() as $item_id): ?>
                <?php foreach($db->getProductById($item_id) as $product): ?>
                    <?php 
                        $price = intval($product["price"]);
                        $total += $price; 
                    ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <?php echo $total . ".00"; ?>
        <?php endif; ?>
    </div>
</div>


<?php include("./inc/footer.php"); ?>