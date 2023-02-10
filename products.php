<?php include("./inc/header.php"); ?>
<?php 
    include("./OOP/Product.php");
    include("./OOP/Cart.php");

    // $db = new Database("localhost", "techstore", "root", "");

    // Get products length
    // code...
    // print_r($dbProducts);
    // $id, $product_name, $description, $price

    $products = [];
    // $dbroducts = $db->getProducts();
    $products[] = $db->getProducts();

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new Cart();
    }
      
    if(isset($_GET['add_to_cart'])) {
        echo "get id";
    //   $item_id = $_GET['id'];
    //   $_SESSION['cart']->addItem($item_id);
    }
    
?>
    <main class="products-main">
        <div class="main-content">
            <div class="products-side">
                <div class="one">
                    <h4>Brand</h4>
                    <ul>
                        <li><a href="">Apple <span>4</span></a></li>
                        <li><a href="">Samsung <span>9</span></a></li>
                        <li><a href="">Sony <span>3</span></a></li>
                        <li><a href="">Nividia <span>5</span></a></li>
                        <li><a href="">Intel <span>4</span></a></li>
                        <li><a href="">Ryzen <span>9</span></a></li>
                        <li><a href="">Lenovo <span>7</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="products-content">
                <h2>Products</h2>
                <div class="filters">
                    <ul>
                        <li class="active">Popular First</li>
                        <li>Newest First</li>
                        <li>Chepest First</li>
                        <li>Discounts First</li>
                    </ul>
                </div>
                <div class="product-cards">
                    <?php foreach($db->getProducts() as $product): ?>
                        <div class="product-card">
                            <a href="view.php?id=<?= $product["id"] ?>">
                                <div class="image">
                                    <img src="./images/<?= $product['product_img'] ?>" alt="">
                                </div>
                                <div class="product-info">
                                    <p style="color: #8c8c8c">Product Info</p>
                                    <p><?= $product["product_name"] ?></p>
                                    <div>
                                        <p><?= $product["price"] ?>$</p>
                                        <p><i class="fa fa-shopping-cart" name="add_to_cart"></i></p>
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

    <script src="../assets/js/main.js"></script>
</body>
</html>