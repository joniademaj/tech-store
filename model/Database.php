<?php 

    class Database {
        private $pdo;
    
        public function __construct($host, $dbname, $username, $password) {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        }

        public function getProductsLength() {
            $sql = "SELECT * FROM `products`";
            $statement = $this->pdo->query($sql);

            $result = [];

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            if($result == 0){
                return 0;
            }
            return count($result);
        }

        public function search() {
            $search_term = "%" . $_GET['q'] . "%";
            $stmt = $this->pdo->prepare("SELECT * FROM `products`
            LEFT JOIN `images` ON products.id = images.product_id 
            WHERE products.product_name LIKE :search_term OR products.description LIKE :search_term");

            $stmt->bindParam(':search_term', $search_term);
            $stmt->execute();

            $results = $stmt->fetchAll();

            return $results;
        }

        public function getProducts() {
            $sql = "SELECT * FROM `products`
            JOIN `images` ON products.id = images.product_id;";
            $statement = $this->pdo->query($sql);

            $result = [];

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            return $result;
        }

        public function getProductById($id) {
            $sql = "SELECT * FROM `products`
            JOIN `images` ON products.id = images.product_id WHERE products.id = $id";
            $statement = $this->pdo->query($sql);

            $result = [];

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            return $result;
        }

        public function addProduct($id, $product_name, $description, $price, $img) {
            $sql = "INSERT INTO `products` (`id`, `product_name`, `description`, `price`) VALUES (?, ?, ?, ?)";
            $statement = $this->pdo->prepare($sql);

            if($statement->execute([$id, $product_name, $description, $price])){
                //header("Location: dashboard.php?action=products");
            }

            $sql = "INSERT INTO `images` (`product_img`, `product_id`)
            VALUES (?, ?)";

            $statement = $this->pdo->prepare($sql);

            if($statement->execute([$img, $id])){
                // header("Location: dashboard.php?action=products");
            }

           
        }

        public function deleteProductById($id) {

            try{
                $this->pdo->beginTransaction();

                $delete_images_query = "DELETE FROM `images` WHERE `product_id` = $id";
                $this->pdo->exec($delete_images_query);
                
                $delete_product_query = "DELETE FROM `products` WHERE `id` = $id";
                $this->pdo->exec($delete_product_query);

                $this->pdo->commit();

                header("Location: ?action=products");

            }catch(PDOException $e){
                $pdo->rollBack();
                echo "Error: " . $e->getMessage();
            }
            
        }

        public function editProductById($id, $product_name, $description, $price, $img){
            
            $this->pdo->beginTransaction();
            
            $products_query = "UPDATE `products` SET `product_name` = '$product_name', `description` ='$description', `price` = '$price' WHERE `id` = '$id'";
            $this->pdo->exec($products_query);
            
            $images_query = "UPDATE `images` SET `product_img` = '$img' WHERE `product_id` = '$id'";
            $this->pdo->exec($images_query);

            $this->pdo->commit();

        }

        public function getRandomProducts() {
            $sql = "SELECT * FROM `products` JOIN `images` ON products.id = images.product_id ORDER BY RAND() LIMIT 3";
            $statement = $this->pdo->query($sql);

            $result = [];

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            return $result;
        }

        public function getUserById($id){
            $sql = "SELECT * FROM `users` WHERE `id` = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$id]);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function payment($orderId, $userId, $product_id){

            $this->pdo->beginTransaction();

            $sql = "INSERT INTO `order_products` (`order_id`, `product_id`) VALUES (?, ?)";
            $statement = $this->pdo->prepare($sql);

            $statement->execute([$orderId, $product_id]);
                
            $sql = "INSERT INTO `orders` (`id`, `user_id`) VALUES (?, ?)";
            $statement = $this->pdo->prepare($sql);

            $statement->execute([$orderId, $userId]);
            
            unset($_SESSION["cart"]);

            header("Location: products.php");

            
            $this->pdo->commit();


        }

        public function getOrders() {
            $statement = $this->pdo->prepare("SELECT * FROM `orders` JOIN  `order_products` ON orders.id = order_products.order_id");
            $statement->execute();
            $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $orders;
        }

        public function deleteOrder($id) {

            try{
                $this->pdo->beginTransaction();

                $delete_order_products = "DELETE FROM `order_products` WHERE `order_id` = $id";
                $this->pdo->exec($delete_order_products);

                $delete_order = "DELETE FROM `orders` WHERE `id` = $id";
                $this->pdo->exec($delete_order);

                $this->pdo->commit();

                header("Location: ?action=orders");

            }catch(PDOException $e){
                $this->pdo->rollBack();
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>
