<?php include("../controller/productsController.php") ?>

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
                    <?php if(!isset($_GET["q"])): ?>
                        <?php foreach($db->getProducts() as $product): ?>
                            <div class="product-card">
                                <a href="view.php?id=<?= $product["product_id"] ?>">
                                    <div class="image">
                                        <img src="../images/<?= $product['product_img'] ?>" alt="">
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
                    <?php else: ?>
                        <?php foreach($db->search() as $product): ?>
                            <div class="product-card">
                                <a href="view.php?id=<?= $product["product_id"] ?>">
                                    <div class="image">
                                        <img src="../images/<?= $product['product_img'] ?>" alt="">
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include("../inc/footer.php"); ?>