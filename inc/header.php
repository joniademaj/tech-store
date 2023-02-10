<?php 
    ob_start();
    session_start();
    include "./database/dbConnection.php"; 
    //include("./OOP/Authentication.php");
    include("./OOP/Database.php");

    if(isset($_GET["action"]) && $_GET["action"] == "log-out"){
        unset($_SESSION["logged_in"]);
        session_destroy();
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="icon" href="images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Tech Shop</title>

    <style>
        <?php include("./assets/style/style.css"); ?>
    </style>
</head>
<body>
    <?php 
        $url = $_SERVER["PHP_SELF"];
        $currentPage = explode("/", $url);
    ?>
    <?php if(end($currentPage) != "Authentication.php" && end($currentPage) != "dashboard.php"  && end($currentPage) != "signup.php" && end($currentPage) != "login.php"): ?>
        <header>
            <div>
                <?php 
                    $db = new Database("localhost", "techstore", "root", "");
                    if(isset($_SESSION["user_id"])){
                        $id = $_SESSION["user_id"];
                    }
                    $user = $db->getUserById($id);
                    $userLogo = null;
                    if($user != null){
                        $userLogo = $user["full_name"][0];
                    }
                ?>
                <nav class="first-nav">
                    <ul>
                        <li><a href="">Find Store</a></li>
                        <li><a href="">Help Center</a></li>
                        <li><a href="">Live Chat</a></li>
                    </ul>
                    <ul>
                        <li><a href=""><i class="fa fa-heart"></i> Watchlist</a></li>
                        <?php if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true): ?>
                            <form action="login.php" method="GET">
                                <li><a href="?action=log-out" class="log-out" name="log-out">Log Out</a></li>
                            </form>
                        <?php endif; ?>
                        <li><a href="" class="user"> <?php echo $userLogo; ?></a></li>
                    </ul>    
                </nav>
                <div class="second-header">
                    <div class="logo">
                        <img src="./images/logo.png" alt="">
                    </div>

                    <nav class="second-nav">
                        <ul class="ul">
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="view/products.php">PRODUCTS</a></li>
                            <li><a href="">BRANDS</a></li>
                            <li><a href="view/dashboard.php">DASHBOARD</a></li>
                            <li><a href="">NEWS</a></li>
                            <li><a href="">SALE</a></li>
                        </ul>
                    </nav>

                    <div class="search">
                        <form action="">
                            <input type="text" placeholder="What you're looking for">
                        </form>
                    </div>

                    <div class="cart">
                        <a href="cart.php"><i class="fa fa-shopping-cart"></i></a>
                    </div>

                    <div class="burger">
                        <div class="line first-line"></div>
                        <div class="line middle-line"></div>
                        <div class="line third-line"></div>
                    </div>
                </div>
            </div>
        </header>

    <?php endif; ?>
