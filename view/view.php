<?php include("../controller/viewController.php"); ?>
    <main>
        <div class="product-page">
            <?php foreach($product as $p): ?>
                <div>
                    <div class="product-info-content">
                        <div class="main-image">
                            <img src="../images/<?= $p["product_img"] ?>" alt="">
                        </div>
                        <div class="product-info">
                            <div class="product-title">
                                <h3><?= $p["product_name"] ?></h3>
                            </div>
                            <div class="price">
                               <p>$ <?= $p["price"] ?></p>
                            </div>
                            <div class="description">
                                <h4>Description</h4>
                                <p><?= $p["description"] ?></p>
                            </div>
                            <div class="btns">
                                <form action="" method="POST">
                                    <button class="add-to-cart" name="add_to_cart">Add To Cart <i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>


            <div class="related-products">
                <div class="related-title">
                    <h3>Related Products</h3>
                </div>
                <div class="product-related-cards">
                    <?php foreach($randomProducts as $rP): ?>
                        <div class="product-card">
                            <a href="view.php?id=<?= $rP["product_id"] ?>">
                                <div class="image">
                                    <img src="../images/<?= $rP['product_img'] ?>" alt="">
                                </div>
                                <div class="product-info">
                                    <p style="color: #8c8c8c"><?= $rP['product_name'] ?></p>

                                    <div>
                                        <p>$<?= $rP['price'] ?></p>
                                        <p><i class="fa fa-shopping-cart"></i></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="images/logo.png" alt="">
            </div>
            <div class="footer-links">
                <div class="col">
                    <h3>Page Linkss asd</h3>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Products</a></li>
                        <li><a href="">News</a></li>
                        <li><a href="">Contact Us</a></li>
                        <li><a href="">Brand</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h3>Trending Brands</h3>
                    <ul>
                        <li><a href="">Apple</a></li>
                        <li><a href="">Samsung</a></li>
                        <li><a href="">Sony</a></li>
                        <li><a href="">LG</a></li>
                        <li><a href="">Nividia</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h3>Account Actions</h3>
                    <ul>
                        <li><a href="">LogIn</a></li>
                        <li><a href="">SignUp</a></li>
                        <li><a href="">Forgot Password</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h3>Product Categories</h3>
                    <ul>
                        <li><a href="">Pc Parts</a></li>
                        <li><a href="">Smart Phones</a></li>
                        <li><a href="">Gaming Chairs</a></li>
                        <li><a href="">Tv</a></li>
                        <li><a href="">Monitors</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="payment-methods">
            <hr>
                <div>
                    <h3>Payment Methods</h3>
                    <div>
                        <i class="fa fa-cc-visa"></i>
                        <i class="fa fa-bitcoin"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-money"></i>
                        <i class="fa fa-bank"></i>
                    </div>
                </div>
            <hr>
        </div>

        <div class="social-media">
            <h4>Follow us</h4>
            <i class="fa fa-instagram"></i>
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>