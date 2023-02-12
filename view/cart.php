<?php include("../model/Cart.php"); ?>
<?php include("../inc/header.php"); ?>

<div class="cart-content">
    <?php if(isset($_SESSION["cart"])): ?>
        <?php foreach($_SESSION['cart']->getItems() as $item_id): ?>
            <?php foreach($db->getProductById($item_id) as $product): ?>
                <div class="cart-item">
                    <div class="image">
                        <img src="../images/<?= $product['product_img'] ?>" alt="">
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
                        <p class="product-price">$ <?= $product["price"] ?></p>
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
            <div class="total-card">
                <h3>Total</h3>
                <h3><?php echo $total; ?> &dollar;</h3>
            </div>
            <div class="pay-btn">
                <a href="?action=payment" class="payment-btn">Pay Now</a>
            </div>
        <?php endif; ?>
    </div>

    <?php 
        if(isset($_GET["action"]) && $_GET["action"] == "payment"){
            $userId = $_SESSION["user_id"];
            $orderId = rand(100,999) . $userId . rand(1, 10);

            foreach($_SESSION["cart"]->getItems() as $product_id){
                $db->payment($orderId, $userId, $product_id);
            }
        }
    ?>
</div>

<?php include("../inc/footer.php"); ?>