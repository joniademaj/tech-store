<?php 
    class Product {

        private $id;
        private $product_name;
        private $description;
        private $price;
        private $product_image;
        private $created_at;

        public function __construct($id, $product_name, $description, $price, $product_image){
            $this->id = $id;
            $this->product_name = $product_name;
            $this->description = $description;
            $this->price = $price;
            $this->product_image = $product_image;
        }

        public function getId() {
            return $this->id;
        }
    
        public function getName() {
            return $this->product_name;
        }

        public function getDescription() {
            return $this->description;
        }
    
        public function getPrice() {
            return $this->price;
        }

        public function getProductImage() {
            return $this->product_image;
        }
    
        public function getCategoryId() {
            return $this->categoryId;
        }

        public function __toString() {
            return $this->id . " - " . $this->product_name . " - " . $this->description . " - " . $this->price . " - " . $this->product_image;
        }
    }
?>