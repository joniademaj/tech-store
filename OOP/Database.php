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

        public function getProducts() {
            // $sql = "SELECT * FROM `products`";
            $sql = "SELECT * FROM `products`
            JOIN `images` ON products.id = images.product_id;";
            $statement = $this->pdo->query($sql);

            $result = [];

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            // print_r($result);
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

            // print_r($result);

            return $result;
        }

        public function addProduct($id, $product_name, $description, $price, $img) {
            $sql = "INSERT INTO `products` (`id`, `product_name`, `description`, `price`) VALUES (?, ?, ?, ?)";
            $statement = $this->pdo->prepare($sql);

            if($statement->execute([$id, $product_name, $description, $price])){
                header("Location: dashboard.php?action=products");
            }

            $sql = "INSERT INTO `images` (`product_img`, `product_id`)
            VALUES (?, ?)";

            $statement = $this->pdo->prepare($sql);

            if($statement->execute([$img, $id])){
                header("Location: dashboard.php?action=products");
            }

            // $sql = "INSERT INTO `images` (`id`,`product_img`,`product_id`)"
        }

        public function deleteProductById($id) {

            $query = "DELETE `products`, `images`
            FROM `products`
            JOIN `images` ON products.product_id = images.product_id
            WHERE products.product_id = :product_id";

            // Prepare the statement
            $stmt = $pdo->prepare($query);

            // Bind the parameters
            $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);

            // Set the value for the parameter
            $product_id = $id;

            // Execute the statement
            $stmt->execute();

            header("Location: dashboard.php?action=products");

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
    }

?>
