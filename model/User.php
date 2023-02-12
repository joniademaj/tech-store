<?php 
    class User {
        
        private $id;
        private $username;
        private $password;
    
        public function __construct($id, $username, $password) {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function getUsername() {
            return $this->username;
        }
    
        public function checkPassword($password) {
            return password_verify($password, $this->password);
        }    
    }
?>